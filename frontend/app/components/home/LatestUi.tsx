// app/components/home/LatestUi.tsx
'use client'

import React from 'react';
import { Entity } from '@/app/lib/types/base-entity';
import { DetailedListItemUi } from '@/app/components/list';

type LatestUiProps = {
    latestItems: Record<string, Entity>;
}

export function LatestUi({ latestItems }: LatestUiProps) {
    const categories = Object.keys(latestItems);

    return (
        <div className="w-full">
            <div className="grid grid-cols-[repeat(auto-fit,minmax(220px,220px))] justify-start gap-4">
                {categories.map(category => (
                    <div key={category} className="flex flex-col w-[220px]">
                        <h2 className="text-xl font-bold mb-4 capitalize">
                            Latest {category}
                        </h2>
                        <DetailedListItemUi
                            entityItem={latestItems[category]}
                            categoryName={category}
                            compact
                        />
                    </div>
                ))}
            </div>
        </div>
    );
}
