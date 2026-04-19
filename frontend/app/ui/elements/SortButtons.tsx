'use client';

import { useRouter, useSearchParams } from 'next/navigation';
import { Button } from '@/app/ui/elements';

export function SortButtons() {
    const router = useRouter();
    const searchParams = useSearchParams();

    const currentSort = searchParams.get('sort') || 'updatedAt:desc';

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
                isActive={currentSort === 'updatedAt:desc'}
                onClick={() => handleSortChange('updatedAt:desc')}
                className="px-6"
            >
                Newest first
            </Button>
            <Button
                variant="secondary"
                isActive={currentSort === 'updatedAt:asc'}
                onClick={() => handleSortChange('updatedAt:asc')}
                className="px-6"
            >
                Oldest first
            </Button>
        </div>
    );
}
