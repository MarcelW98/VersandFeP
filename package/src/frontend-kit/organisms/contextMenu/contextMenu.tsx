/* eslint-disable no-use-before-define */
/* eslint-disable import/prefer-default-export */
import * as React from 'react';
import { Button } from '../../atoms/button/button';
import { MenuItem } from '../../atoms/menuItem/menuItem';
import { Popover } from '../../molecules/popover/popover';

/**
 * @name      o-context-menu
 * @type      organism
 * @author    Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param {string}  name                    The context menu's name. Optional.
 * @param {boolean} links                   The navigation's links to display.
 * @param {boolean} isPopoverArrowMissing   Wether or not showing the arrow's popover.
 *
 * @description
 * representation of Context Menu
 */

interface ContextMenuLink {
  label: string;
  iconName?: string;
  hasArrowDown?: boolean;
  hasArrowRight?: boolean;
  hasDivider?: boolean;
  isDisabled?: boolean;
  url?: string;
  subNavigation?: ContextMenuLink[];
}
interface ContextMenuProps {
  name?: string;
  links: ContextMenuLink[];
  isPopoverArrowMissing?: boolean;
}

const ContextMenu: React.FunctionComponent<ContextMenuProps> = ({
  name,
  links = [],
  isPopoverArrowMissing = false,
}) => {
  return (
    <>
      <nav
        className="o-context-menu"
        aria-label={`Context Menu Navigation ${name}`}
        aria-hidden="false"
      >
        {!isPopoverArrowMissing && (
          <>
            <Button
              type="button"
              aria-label="Open Context Menu"
              mode="integrated"
              icon="options"
              aria-haspopup="false"
              additionalClasses={['o-context-menu__trigger']}
              action="open"
            />
            <Button
              type="button"
              mode="integrated"
              icon="close"
              aria-label="Close Context Menu"
              aria-haspopup="false"
              additionalClasses={['o-context-menu__trigger']}
              action="close"
            />
          </>
        )}
        <Popover isPopoverArrowMissing={isPopoverArrowMissing} detached={false}>
          <ul className="o-context-menu__menuItems" role="menubar">
            {links.map(
              (
                {
                  label,
                  iconName,
                  hasArrowDown = false,
                  hasArrowRight = false,
                  hasDivider = false,
                  isDisabled = false,
                  subNavigation = [],
                  url,
                },
                index,
              ) => (
                <MenuItem
                  label={label}
                  iconName={iconName}
                  hasArrowDown={hasArrowDown}
                  hasArrowRight={hasArrowRight}
                  hasDivider={hasDivider}
                  isDisabled={isDisabled}
                  url={url}
                  key={index}
                >
                  {(hasArrowRight || hasArrowDown) && (
                    <ul
                      className={`o-context-menu__menuSubitems${
                        hasArrowRight ? '--beside -floating' : ''
                      }`}
                      role="menu"
                    >
                      {subNavigation.map((subItem, i) => (
                        <MenuItem
                          label={subItem.label}
                          key={i}
                          url={subItem.url}
                          hasDivider={subItem.hasDivider}
                        />
                      ))}
                    </ul>
                  )}
                </MenuItem>
              ),
            )}
          </ul>
        </Popover>
      </nav>
    </>
  );
};

export { ContextMenu };
export type { ContextMenuProps };
