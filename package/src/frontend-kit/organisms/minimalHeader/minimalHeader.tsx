import * as React from 'react';
import {
  SideNavigation,
  SideNavigationProps,
} from '../../molecules/sideNavigation/sideNavigation';
import Logo from '../header/parts/logo';
import { Button } from '../../atoms/button/button';
import { ContextMenu, ContextMenuProps } from '../contextMenu/contextMenu';

interface Action {
  label: string;
  icon: string;
  url: string;
  showLabelInHeader?: boolean;
}
export interface MinimalHeaderProps {
  sideNavigation: SideNavigationProps;
  actions: Action[];
}

const MinimalHeader: React.FunctionComponent<MinimalHeaderProps> = ({
  sideNavigation,
  actions,
}) => {
  const contextMenuLinksFromActions: ContextMenuProps['links'] = actions.map(
    ({ label, icon: iconName, url }) => ({
      label,
      iconName,
      url,
    }),
  );
  return (
    <header className="o-minimal-header">
      {/* eslint-disable-next-line react/jsx-props-no-spreading */}
      <SideNavigation {...sideNavigation} />
      <div className="o-minimal-header__supergraphic" />
      <div className="o-minimal-header__top">
        <div className="o-minimal-header__burger">
          <Button
            mode="integrated"
            icon="menu"
            aria-label="Side Navigation"
            isUiIcon
          />
        </div>
        <div className="o-minimal-header__title">Page Name Lorem Ipsum</div>
        <ul className="o-minimal-header__actions">
          {actions.map((action) => (
            <li key={action.label}>
              <Button
                mode="integrated"
                icon={action.icon}
                label={action.showLabelInHeader && action.label}
                action={action.url}
              />
            </li>
          ))}
        </ul>
        <Logo component="o-minimal-header" />
        <div className="o-minimal-header__falafel">
          <ContextMenu links={contextMenuLinksFromActions} />
        </div>
      </div>
    </header>
  );
};

export default MinimalHeader;
