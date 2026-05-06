// app/components/auth/api/logout.ts

import { getBrowserApiUrl } from "@/app/lib/config";
import { getCsrfHeaders } from "@/app/lib/csrf";

export async function logout(): Promise<{ message: string }> {
    const apiBase = getBrowserApiUrl();
    const apiUrl = apiBase ? `${apiBase}/api/logout` : '/api/logout';
    const response = await fetch(apiUrl, {
        method: 'POST',
        credentials: 'include',
        headers: getCsrfHeaders(),
    });

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.error || 'Logout failed');
    }

    return response.json();
}
