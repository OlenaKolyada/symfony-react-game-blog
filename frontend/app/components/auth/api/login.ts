// app/components/auth/api/login.ts

import { getBrowserApiUrl } from "@/app/lib/config";

interface LoginCredentials {
    email: string;
    password: string;
}

export async function login(credentials: LoginCredentials): Promise<{ message: string }> {
    const apiBase = getBrowserApiUrl();
    const apiUrl = apiBase ? `${apiBase}/api/login` : '/api/login';
    const response = await fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include',
        body: JSON.stringify(credentials),
    });

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.error || 'Login failed');
    }

    return response.json();
}
