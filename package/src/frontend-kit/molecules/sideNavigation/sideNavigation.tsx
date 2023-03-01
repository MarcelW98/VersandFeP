/* eslint-disable import/prefer-default-export */
/* eslint-disable-next-line no-use-before-define */
import * as React from 'react';
import { Icon } from '../../atoms/icon/icon';
import { SideNavigationHeader } from './parts/sideNavigationHeader';

interface SubItem {
  label: string;
  url: string;
  isDisabled?: boolean;
}

interface MenuItem {
  label: string;
  icon: string;
  url?: string;
  isDisabled?: boolean;
  subItems?: SubItem[];
}

interface SideNavigationProps {
  menuItems: MenuItem[];
  appName: string;
}

/**
 *
 * @name m-side-navigation
 * @type molecule
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param {string} appName              The App's name.
 * @param {boolean} menuItems           Menu items to display.
 *
 * @description
 * representation of side navigation
 */

const SideNavigation: React.FunctionComponent<SideNavigationProps> = ({
  appName,
  menuItems,
}) => {
  return (
    <nav
      className="m-side-navigation -contrast"
      aria-label="Side Navigation"
      aria-hidden="false"
    >
      <SideNavigationHeader appName={appName} />
      <ul className="m-side-navigation__menuItems" role="menubar">
        {menuItems.map((menuItem, index) =>
          menuItem.subItems ? (
            <React.Fragment key={index}>
              <li
                className={`m-side-navigation__menuItem ${
                  menuItem.isDisabled === true ? '-disabled' : ''
                }`}
                role="none"
              >
                <button
                  type="button"
                  key={index}
                  className="m-side-navigation__group"
                  tabIndex={menuItem.isDisabled ? -1 : null}
                >
                  <Icon iconName={menuItem.icon} titleText={menuItem.label} />
                  <span className="m-side-navigation__label">
                    {menuItem.label}
                  </span>
                  <Icon iconName="down" titleText="down" className="arrow" />
                </button>
                <ul className="m-side-navigation__menuSubitems" role="menu">
                  {menuItem.subItems.map(({ url, label, isDisabled }, i) => {
                    return (
                      <li
                        key={i}
                        className={`m-side-navigation__menuSubitem ${
                          isDisabled === true ? '-disabled' : ''
                        }`}
                        role="none"
                      >
                        <a
                          href={url}
                          key={i}
                          role="menuitem"
                          className="m-side-navigation__link"
                          aria-disabled={isDisabled}
                          tabIndex={-1}
                        >
                          <span className="m-side-navigation__label">
                            {label}
                          </span>
                        </a>
                      </li>
                    );
                  })}
                </ul>
              </li>
            </React.Fragment>
          ) : (
            <li
              className={`m-side-navigation__menuItem ${
                menuItem.isDisabled === true ? '-disabled' : ''
              }`}
              key={index}
              role="none"
            >
              <a
                href={menuItem.url}
                role="menuitem"
                className="m-side-navigation__link"
                tabIndex={menuItem.isDisabled ? -1 : null}
              >
                <Icon iconName={menuItem.icon} titleText={menuItem.label} />
                <span className="m-side-navigation__label">
                  {menuItem.label}
                </span>
              </a>
            </li>
          ),
        )}
      </ul>
    </nav>
  );
};

export { SideNavigation };
export type { SideNavigationProps };
