'use client'

import Link from 'next/link';
import { useEffect, useMemo, useState } from 'react';
import { useAuth } from '@/app/components/auth';
import { createComment, deleteComment, updateComment } from '@/app/lib/fetch';
import { Comment } from '@/app/lib/types';
import { Button } from '@/app/ui/elements';

interface CommentsSectionProps {
    comments?: Comment[];
    reviewId: number;
}

function formatDate(value?: Date | string) {
    if (!value) {
        return '';
    }

    const date = value instanceof Date ? value : new Date(value);

    if (Number.isNaN(date.getTime())) {
        return String(value);
    }

    return date.toLocaleString();
}

export function CommentsSection({ comments = [], reviewId }: CommentsSectionProps) {
    const { user, isAuthenticated, loading } = useAuth();
    const [items, setItems] = useState<Comment[]>(comments);
    const [newComment, setNewComment] = useState('');
    const [editingId, setEditingId] = useState<number | null>(null);
    const [editingContent, setEditingContent] = useState('');
    const [submitting, setSubmitting] = useState(false);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        setItems(comments);
    }, [comments]);

    const sortedItems = useMemo(
        () => [...items].sort(
            (left, right) => new Date(right.createdAt).getTime() - new Date(left.createdAt).getTime()
        ),
        [items]
    );

    async function handleCreate() {
        const content = newComment.trim();
        if (!content) {
            return;
        }

        setSubmitting(true);
        setError(null);

        try {
            const created = await createComment({ content, review: reviewId });
            setItems((current) => [created, ...current]);
            setNewComment('');
        } catch (err) {
            setError((err as Error).message);
        } finally {
            setSubmitting(false);
        }
    }

    async function handleUpdate(commentId: number) {
        const content = editingContent.trim();
        if (!content) {
            return;
        }

        setSubmitting(true);
        setError(null);

        try {
            const updated = await updateComment(commentId, { content });
            setItems((current) => current.map((item) => item.id === commentId ? updated : item));
            setEditingId(null);
            setEditingContent('');
        } catch (err) {
            setError((err as Error).message);
        } finally {
            setSubmitting(false);
        }
    }

    async function handleDelete(commentId: number) {
        setSubmitting(true);
        setError(null);

        try {
            await deleteComment(commentId);
            setItems((current) => current.filter((item) => item.id !== commentId));
        } catch (err) {
            setError((err as Error).message);
        } finally {
            setSubmitting(false);
        }
    }

    return (
        <section className="mx-1 md:mx-9 mt-8 border-t border-gray-200 pt-6">
            <div className="mb-6 flex items-center justify-between gap-4">
                <h2 className="text-2xl font-semibold text-slate-900">Comments</h2>
                <span className="text-sm text-slate-500">{sortedItems.length}</span>
            </div>

            {error && (
                <div className="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    {error}
                </div>
            )}

            {!loading && !isAuthenticated && (
                <div className="mb-6 rounded border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
                    <Link href="/login" className="font-medium text-teal-700 hover:underline">
                        Sign in
                    </Link>{' '}
                    to comment.
                </div>
            )}

            {isAuthenticated && (
                <div className="mb-8 rounded border border-slate-200 bg-slate-50 p-4">
                    <label htmlFor="new-comment" className="mb-3 block text-sm font-medium text-slate-800">
                        Add a comment
                    </label>
                    <textarea
                        id="new-comment"
                        value={newComment}
                        onChange={(event) => setNewComment(event.target.value)}
                        rows={4}
                        className="w-full resize-y rounded border border-slate-300 px-3 py-2 text-sm text-slate-900 outline-none focus:border-blue-500"
                        placeholder="Write your comment here"
                    />
                    <div className="mt-3 flex justify-end">
                        <Button
                            type="button"
                            onClick={handleCreate}
                            disabled={submitting || !newComment.trim()}
                            className="justify-center"
                        >
                            Post comment
                        </Button>
                    </div>
                </div>
            )}

            <div className="space-y-4">
                {sortedItems.length === 0 && (
                    <div className="rounded border border-slate-200 bg-white px-4 py-6 text-sm text-slate-500">
                        No comments yet.
                    </div>
                )}

                {sortedItems.map((comment) => {
                    const isOwner = user?.id === comment.author?.id;
                    const isEditing = editingId === comment.id;

                    return (
                        <article key={comment.id} className="rounded border border-slate-200 bg-white px-4 py-4 shadow-sm">
                            <div className="mb-3 flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <div className="font-medium text-slate-900">{comment.author?.nickname ?? 'Unknown user'}</div>
                                    <div className="text-xs text-slate-500">
                                        {formatDate(comment.createdAt)}
                                        {comment.status === 'Edited' && ' · edited'}
                                    </div>
                                </div>

                                {isOwner && (
                                    <div className="flex gap-2">
                                        {!isEditing && (
                                            <Button
                                                type="button"
                                                variant="secondary"
                                                onClick={() => {
                                                    setEditingId(comment.id);
                                                    setEditingContent(comment.content);
                                                }}
                                            >
                                                Edit
                                            </Button>
                                        )}
                                        <Button
                                            type="button"
                                            variant="secondary"
                                            onClick={() => handleDelete(comment.id)}
                                            disabled={submitting}
                                        >
                                            Delete
                                        </Button>
                                    </div>
                                )}
                            </div>

                            {isEditing ? (
                                <div>
                                    <textarea
                                        value={editingContent}
                                        onChange={(event) => setEditingContent(event.target.value)}
                                        rows={4}
                                        className="w-full resize-y rounded border border-slate-300 px-3 py-2 text-sm text-slate-900 outline-none focus:border-blue-500"
                                    />
                                    <div className="mt-3 flex justify-end gap-2">
                                        <Button
                                            type="button"
                                            variant="secondary"
                                            onClick={() => {
                                                setEditingId(null);
                                                setEditingContent('');
                                            }}
                                        >
                                            Cancel
                                        </Button>
                                        <Button
                                            type="button"
                                            onClick={() => handleUpdate(comment.id)}
                                            disabled={submitting || !editingContent.trim()}
                                        >
                                            Save
                                        </Button>
                                    </div>
                                </div>
                            ) : (
                                <p className="whitespace-pre-wrap text-sm leading-6 text-slate-700">{comment.content}</p>
                            )}
                        </article>
                    );
                })}
            </div>
        </section>
    );
}
