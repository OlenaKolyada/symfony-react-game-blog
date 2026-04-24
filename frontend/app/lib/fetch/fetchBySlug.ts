// app/lib/fetch/fetchBySlug.ts
import { baseFetch } from '@/app/lib/fetch/baseFetch';
import { API_URL } from '@/app/lib/config';

export async function fetchEntityBySlug<T>(
    entityType: string,
    slug: string
): Promise<T | null> {
    if (!slug) {
        console.error("Slug is required");
        throw new Error("Slug is required");
    }

    console.log(`Fetching ${entityType} with slug: ${slug}`);

    try {
        try {
            console.log(`Using baseFetch for ${entityType}/resolve/${slug}`);
            const data = await baseFetch<T>(`${entityType}/resolve/${slug}`);
            console.log(`baseFetch success, got data:`, data);
            return data;
        } catch (baseFetchError) {
            console.warn(`baseFetch failed:`, baseFetchError);

            const directUrl = API_URL
                ? `${API_URL}/api/${entityType}/resolve/${slug}`
                : `/api/${entityType}/resolve/${slug}`;

            // Fall back to a direct request if the shared fetch wrapper fails.
            console.log(`Falling back to direct fetch at ${directUrl}`);
            const response = await fetch(directUrl);

            if (response.status === 404) {
                console.log(`Entity not found: ${entityType}/${slug} (404)`);
                return null;
            }

            if (!response.ok) {
                throw new Error(`HTTP error ${response.status}`);
            }

            const data = await response.json();
            console.log(`Direct fetch success, got data:`, data);
            return data as T;
        }
    } catch (error) {
        console.error(`Error fetching entity ${entityType}/${slug}:`, error);
        return null;
    }
}
