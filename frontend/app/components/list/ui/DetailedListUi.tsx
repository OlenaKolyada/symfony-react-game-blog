// app/components/list/ui/DetailedListUi.tsx
'use client'

import React from 'react';
import { DetailedListLayoutProps, useGridData } from '@/app/components/list';

export function DetailedListUi({
                                   entityItems = [],
                                   categoryNames = [],
                                   entityItem,
                                   relatedCategoryNames = [],
                                   renderEntityCard,
                                   status,
                                   compact = false
                               }: DetailedListLayoutProps) {

    const { rows, hasContent } = useGridData(
        renderEntityCard,
        entityItems,
        categoryNames,
        entityItem,
        relatedCategoryNames,
        status
    );

    if (!hasContent) {
        return null;
    }

    const gridItems = rows.flat();

    return (
        <div className={compact
            ? "grid grid-cols-[repeat(auto-fit,minmax(220px,220px))] justify-start gap-4"
            : "grid grid-cols-1 min-[751px]:grid-cols-2 min-[1201px]:grid-cols-3 gap-6"
        }>
            {gridItems}
        </div>
    );
}
