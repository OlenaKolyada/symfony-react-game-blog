import { API_CONFIG } from "@/app/lib/config";
import { getApiBase } from "@/app/lib/fetch/baseFetch";
import { Comment } from "@/app/lib/types";

type CommentPayload = {
    content: string;
    review: number;
};

type UpdateCommentPayload = {
    content: string;
};

async function request<T>(endpoint: string, options: RequestInit): Promise<T> {
    const base = getApiBase();
    const url = base ? `${base}/api/${endpoint}` : `/api/${endpoint}`;

    const response = await fetch(url, {
        credentials: 'include',
        headers: API_CONFIG.headers,
        ...options,
    });

    if (!response.ok) {
        let message = `HTTP error ${response.status}`;

        try {
            const data = await response.json();
            if (data?.error) {
                message = data.error;
            }
        } catch {
            // keep default message
        }

        throw new Error(message);
    }

    if (response.status === 204) {
        return undefined as T;
    }

    return response.json();
}

export function createComment(payload: CommentPayload): Promise<Comment> {
    return request<Comment>('comment', {
        method: 'POST',
        body: JSON.stringify(payload),
    });
}

export function updateComment(commentId: number, payload: UpdateCommentPayload): Promise<Comment> {
    return request<Comment>(`comment/${commentId}`, {
        method: 'PATCH',
        body: JSON.stringify(payload),
    });
}

export function deleteComment(commentId: number): Promise<void> {
    return request<void>(`comment/${commentId}`, {
        method: 'DELETE',
    });
}
