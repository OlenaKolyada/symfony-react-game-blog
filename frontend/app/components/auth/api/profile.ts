// app/components/auth/api/profile.ts

import {User} from "@/app/lib/types";
import { API_URL } from "@/app/lib/config"

export async function profile(): Promise<User | null> {
    const apiUrl = API_URL ? `${API_URL}/api/profile` : '/api/profile';
    const response = await fetch(apiUrl, {
        credentials: 'include',
    });

    if (response.status === 401) {
        // Пользователь не авторизован, возвращаем null
        return null;
    }

    if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(errorData.error || 'Failed to get profile');
    }

    return response.json();
}
