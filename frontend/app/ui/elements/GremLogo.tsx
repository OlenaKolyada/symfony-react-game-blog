// app/ui/elements/GremLogo.tsx

import Image from 'next/image';
import Link from 'next/link';

export function GremLogo() {
    return (
        <div className="w-44 flex justify-center items-center">
            <Link href='/'>
                <Image
                    src="/uploads/images/assets/logo.png"
                    alt="Grem Logo"
                    width={100}
                    height={69}
                />
            </Link>
        </div>
    );
}
