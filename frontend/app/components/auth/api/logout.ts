// app/components/auth/api/logout.ts

import { API_URL } from "@/app/lib/config";

export async function logout(): Promise<{ message: string }> {
    const apiUrl = API_URL ? `${API_URL}/api/logout` : '/api/logout';
    const response = await fetch(apiUrl, {
        method: 'POST',
        credentials: 'include',
    });

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.error || 'Logout failed');
    }

    return response.json();
}
