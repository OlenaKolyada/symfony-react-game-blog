// app/lib/config/config.ts

export const CORE_ENTITIES = ['game', 'news', 'review'];
export const META_ENTITIES = ['developer', 'genre', 'platform', 'publisher', 'tag'];

export const API_URL = process.env.NEXT_PUBLIC_API_URL ?? '';

export function getBrowserApiUrl(): string {
    if (typeof window === 'undefined' || !API_URL) {
        return API_URL;
    }

    const currentHost = window.location.hostname;
    if (!['localhost', '127.0.0.1'].includes(currentHost)) {
        return API_URL;
    }

    try {
        const url = new URL(API_URL);

        if (['localhost', '127.0.0.1'].includes(url.hostname)) {
            url.hostname = currentHost;
        }

        return url.toString().replace(/\/$/, '');
    } catch {
        return API_URL;
    }
}

export const API_CONFIG = {
    timeout: 10000,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    }
};
