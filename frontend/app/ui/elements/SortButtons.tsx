'use client';

import { useRouter, useSearchParams } from 'next/navigation';
import { Button } from '@/app/ui/elements';

export function SortButtons() {
    const router = useRouter();
    const searchParams = useSearchParams();

    const currentSort = searchParams.get('sort') || 'createdAt:desc';

    const handleSortChange = (sortValue: string) => {
        const params = new URLSearchParams(searchParams.toString());
        params.set('sort', sortValue);
        params.set('page', '1');
        router.push(`?${params.toString()}`);
    };

    return (
        <div className="mb-4 flex gap-2">
            <Button
                variant="secondary"
                isActive={currentSort === 'createdAt:desc'}
                onClick={() => handleSortChange('createdAt:desc')}
                className="px-6"
            >
                Newest first
            </Button>
            <Button
                variant="secondary"
                isActive={currentSort === 'createdAt:asc'}
                onClick={() => handleSortChange('createdAt:asc')}
                className="px-6"
            >
                Oldest first
            </Button>
        </div>
    );
}
