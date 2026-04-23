// app/lib/fetch/baseFetch.ts
import { API_URL, API_CONFIG } from "@/app/lib/config";

export const getApiBase = () =>
    typeof window === 'undefined'
        ? (process.env.API_URL_INTERNAL || API_URL)
        : API_URL;

export async function baseFetch<T>(
    endpoint: string,
    queryParams?: Record<string, string>
): Promise<T> {
    const base = getApiBase();
    if (!base) {
        throw new Error("API_URL is not defined");
    }

    let url = `${base}/api/${endpoint}`;
    if (queryParams && Object.keys(queryParams).length > 0) {
        const searchParams = new URLSearchParams(queryParams);
        url += `?${searchParams.toString()}`;
    }

    const response = await fetch(url, {
        method: "GET",
        headers: API_CONFIG.headers,
        credentials: 'include'
    });

    if (!response.ok) {
        throw new Error(`HTTP error ${response.status}`);
    }

    return response.json();
}
