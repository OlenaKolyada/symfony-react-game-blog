export function getCsrfHeaders(): Record<string, string> {
    const token = getCookieValue('csrf_token');

    return token ? { 'X-CSRF-Token': token } : {};
}

function getCookieValue(name: string): string | null {
    if (typeof document === 'undefined') {
        return null;
    }

    const cookie = document.cookie
        .split('; ')
        .find((part) => part.startsWith(`${name}=`));

    return cookie ? decodeURIComponent(cookie.slice(name.length + 1)) : null;
}
