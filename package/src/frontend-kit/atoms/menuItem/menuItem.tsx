/* eslint-disable import/prefer-default-export */
// eslint-disable-next-line no-use-before-define
import * as React from 'react';

import { Divider } from '../divider/divider';
import { Icon } from '../icon/icon';

class MenuItemProps {
  label: string;
  hasArrowRight?: boolean;
  hasArrowDown?: boolean;
  hasDivider?: boolean;
  iconName?: string;
  isDisabled?: boolean;
  url?: string;
  children?: React.ReactNode;
}

/**
 * @name            a-menuItem
 * @type            atom
 * @author          Experience One AG
 * @copyright       Robert Bosch GmbH
 *
 * @param           {string}  label           Label to display inside the menu item.
 * @param           {boolean} hasArrowRight   Wheter or not the menu item has an arror right icon.
 * @param           {boolean} hasArrowDown    Wheter or not the menu item has an arror down icon.
 * @param           {boolean} hasDivider      Wheter or not the menu item has a divider after it.
 * @param           {string}  iconName        The icon to display if the menu item has one.
 * @param           {boolean} isDisabled      Wheter or not the menu item is disabled.
 * @param           {string}  url             The menu item's link.
 *
 * @description
 * representation of menuItems
 */

const menuLabel = (label, iconName) => {
  return (
    <>
      {iconName && <Icon iconName={iconName} titleText={iconName} />}
      <span className="a-menu-item__label">{label}</span>
    </>
  );
};

const MenuItem: React.FunctionComponent<MenuItemProps> = ({
  hasArrowRight,
  hasArrowDown,
  hasDivider,
  label,
  iconName,
  isDisabled,
  children,
  url,
}) => {
  return (
    <>
      <li
        className={`a-menu-item ${isDisabled ? '-disabled' : ''}`}
        role="none"
      >
        {hasArrowDown ? (
          <button type="button" className="a-menu-item__group">
            {menuLabel(label, iconName)}
            {hasArrowDown && <Icon iconName="down" titleText="down" />}
          </button>
        ) : (
          <a href={url} role="menuitem" className="a-menu-item__link">
            {menuLabel(label, iconName)}
            {hasArrowRight && (
              <Icon iconName="forward-right" titleText="forward-right" />
            )}
          </a>
        )}
        {children}
      </li>
      {hasDivider && <Divider />}
    </>
  );
};

export { MenuItem, MenuItemProps };
