/* eslint-disable-next-line no-use-before-define */
import * as React from 'react';
import { FunctionComponent } from 'react';
import { Button } from '../../../atoms/button/button';


interface SideNavigationHeaderProps {
  appName: string;
}

const SideNavigationHeader: FunctionComponent<SideNavigationHeaderProps> = ({
  appName,
}) => {
  return (
    <div className="m-side-navigation__header">
      <div className="m-side-navigation__header__label -size-l highlight">
        {appName}
      </div>
      <Button
        type="button"
        mode="integrated"
        icon="list-view-mobile"
        aria-label="Open Side Navigation"
        aria-haspopup="false"
        additionalClasses={['m-side-navigation__header__trigger -open']}
        tabIndex={0}
      />
      <Button
        type="button"
        mode="integrated"
        icon="close"
        aria-label="Close Side Navigation"
        aria-haspopup="false"
        additionalClasses={['m-side-navigation__header__trigger -close']}
        tabIndex={-1}
      />
    </div>
  );
};

export { SideNavigationHeader };
export type { SideNavigationHeaderProps };
