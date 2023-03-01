/* eslint-disable max-classes-per-file */
import classNames from 'classnames';
import * as React from 'react';
import { Icon } from '../icon/icon';

/**
 * a typescript helper function that tells typescript that a TabLink is indeed a TabLink
 */
const isLinkTab = (tab: Tab): tab is LinkTab => tab.type === 'link';

interface Tab {
  type: 'link' | 'button';
  identifier: string;
  label?: string;
  icon?: string;
  isDisabled?: boolean;
  isSelected?: boolean;
  isOnlyIcon?: boolean;
}

interface LinkTab extends Tab {
  type: 'link';
  href: string;
}
interface TabNavigationProps {
  tabs: Tab[];
}

/**
 * helper for the CSS classes a tab should have
 */
const tabClassNames = (tab: Tab): string =>
  classNames(['a-tab-navigation__tab'], {
    '-selected': tab.isSelected,
    '-disabled': tab.isDisabled,
    '-only-icon': tab.isOnlyIcon
  });

/**
 * render helper for repeating parts in the branches of TabNavigation
 */
const TabLabelContent: React.FunctionComponent<{ tab: Tab }> = ({ tab }) => (
  <span className="a-tab-navigation__tab-content">
    {tab.icon && (
      <Icon
        iconName={tab.icon}
        className="a-tab-navigation__icon"
        titleText="Lorem Ipsum"
      />
    )}
    {tab.label && <span className="a-tab-navigation__label">{tab.label}</span>}
  </span>
);

/**
 * @name      a-tab-navigation
 * @type      atom
 * @author    Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {string}    type    Type of Tabs Definition (Labels, Icons, or Labels&Icons)
 * @param   {TabProps}  tabs    The tabs the TabNavigation consists of

 *
 * @description
 * representation of Tab Navigation components
 */

const TabNavigation: React.FunctionComponent<TabNavigationProps> = ({
  tabs = [],
}: TabNavigationProps) => {
  return (
    <ol className="a-tab-navigation">
      {tabs.map(tab => {
        return (
          <li key={tab.identifier} className="a-tab-navigation__item">
            {isLinkTab(tab) && (
              <a
                href={tab.href}
                className={tabClassNames(tab)}
                tabIndex={tab.isDisabled ? -1 : 0}
              >
                <TabLabelContent tab={tab} />
              </a>
            )}
            {!isLinkTab(tab) && (
              <button
                type="button"
                className={tabClassNames(tab)}
                aria-pressed={tab.isSelected}
                data-frok-tab-identifier={tab.identifier}
                tabIndex={tab.isDisabled ? -1 : 0}
              >
                <TabLabelContent tab={tab} />
              </button>
            )}
          </li>
        );
      })}
    </ol>
  );
};

export { TabNavigation };
export type { TabNavigationProps };
