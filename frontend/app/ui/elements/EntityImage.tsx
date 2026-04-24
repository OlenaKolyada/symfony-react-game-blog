import Image from "next/image";

interface EntityImageProps {
    id: number | undefined;
    categoryName: string;
    title?: string;
    coverUrl?: string;
    width?: string;
    height?: string;
    className?: string;
    imageType?: 'cover' | 'avatar'; // Новый параметр
}

export function EntityImage({
                                id,
                                categoryName,
                                title,
                                coverUrl,
                                width = "w-full",
                                height = "h-[250px]",
                                className = "",
                                imageType = 'cover'
                            }: EntityImageProps) {
    const normalizePath = (path: string) => path.startsWith('/') ? path : `/${path}`;

    const imageUrl = coverUrl
        ? (coverUrl.startsWith('http') ? coverUrl : normalizePath(coverUrl))
        : `/uploads/images/${categoryName}/${id}/${imageType}.jpg`;

    return (
        <div className={`relative ${width} ${height} shrink-0 overflow-hidden ${className}`}>
            <Image
                src={imageUrl}
                alt={title ?? ''}
                fill
                className="object-cover object-center rounded-lg"
                sizes="(max-width: 768px) 100vw, 400px"
            />
        </div>
    );
}
