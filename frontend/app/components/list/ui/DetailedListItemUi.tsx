'use client'

import React from 'react';
import Link from 'next/link';
import * as em from '@/app/ui/elements/EntityMetadata';
import { ListItemProps } from '@/app/components/list';
import { EntityImage, ReadMore } from "@/app/ui/elements";

export function DetailedListItemUi({
                                       entityItem,
                                       categoryName,
                                       compact = false
                                   }: ListItemProps) {
    return (
        <div
            className={`bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 ${
                compact ? 'p-2 md:p-3 w-[220px]' : 'p-4 md:p-6'
            }`}
        >
            <div className="flex mb-1">
                <em.EntityCategory category={entityItem._categoryName || categoryName} />
            </div>

            <div className="flex flex-wrap mb-1">
                {!compact && <em.EntityStatus status={entityItem.status} />}
                {!compact && <em.EntityDate date={entityItem.updatedAt} />}
                {!compact && entityItem.author && <em.EntityAuthor author={entityItem.author} />}
            </div>

            <Link href={`/${entityItem._categoryName || categoryName}/${entityItem.slug || entityItem.id}`} className="block">
                <em.EntityTitle
                    title={entityItem.title}
                    className={compact ? "font-semibold text-gray-900 mr-1 mb-2 text-base" : undefined}
                />
                <EntityImage
                    id={entityItem.id}
                    categoryName={entityItem._categoryName || categoryName}
                    title={entityItem.title}
                    coverUrl={entityItem?.coverUrl}
                    height={compact ? "aspect-[16/9] h-auto" : "h-[250px]"}
                />
            </Link>

            {!compact && <em.EntitySummary summary={entityItem.summary || ''} className={undefined} />}
            <div className={compact ? "pt-2" : ""}>
                <ReadMore
                    id={entityItem.id}
                    slug={entityItem.slug}
                    categoryName={entityItem._categoryName || categoryName}
                />
            </div>
        </div>
    );
}
