// app/components/menu/SideMenuUi.tsx
import { NavLinksUi } from '@/app/components/menu';

const sideMenuUiStyles = {
    link: 'flex h-[48px] max-w-[192px] items-center justify-start gap-2 rounded-md p-2 text-sm font-medium md:flex-none md:justify-start md:p-2 md:px-3',
    activeLink: '',
    text: 'block',
};

export function SideMenuUi() {
    return (
        <div className="flex h-full w-56 flex-col px-2 py-4">
            <div className="flex grow flex-col">
                <NavLinksUi
                    styles={sideMenuUiStyles}
                />
            </div>
        </div>
    );
}
