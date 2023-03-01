// eslint-disable-next-line no-use-before-define
import * as React from 'react';
import { Button } from '../../../atoms/button/button';
import { Icon } from '../../../atoms/icon/icon';
import { Link } from '../../../atoms/link/link';
import { LanguageSelector } from '../../../molecules/languageSelector/languageSelector';

interface NavigationEntry {
  label: string;
  isExternal?: boolean;
  href?: string;
  subNavigation?: NavigationEntry[];
}

interface NavigationProps {
  navigation: NavigationEntry[];
  languages?: string[];
}

/**
 *
 * @name      o-header__navigation
 * @type      organism
 * @author    Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param {NavigationEntry[]} navigation    NavigationItems to display.
 * @param {string[]} languages              Optional languages to display.
 *
 * @description
 * representation of header's navigation
 */

const linkClassNames = ({ isExternal }: NavigationEntry): string[] => {
  const classes = ['o-header__navigation-trigger'];

  if (isExternal) {
    return ['o-header__navigation-trigger--external', ...classes];
  }

  return classes;
};

const NavigationItem: React.FunctionComponent<{
  entry: NavigationEntry;
  level?: number;
}> = ({
  entry: { label, href = '/', subNavigation = [], isExternal = false },
  level = 0,
}) => (
  <>
    {subNavigation.length === 0 && (
      <Link
        level="simple"
        label={label}
        href={href}
        tabIndex={level === 0 ? 0 : -1}
        target={isExternal ? '_blank' : '_self'}
        additionalClasses={linkClassNames({
          label,
          href,
          subNavigation,
          isExternal,
        })}
      />
    )}
    {subNavigation.length > 0 && (
      <>
        <Button
          mode="integrated"
          label={label}
          additionalClasses={['o-header__navigation-trigger']}
          aria-haspopup="true"
          aria-expanded="false"
          tabIndex={level === 0 ? 0 : -1}
        />
        <Icon
          iconName="right"
          className="o-header__navigation-arrow"
          isUiIcon
        />
        <ul
          className="o-header__navigation-sub-level"
          role="menu"
          aria-hidden="true"
        >
          <Button
            mode="integrated"
            icon="arrow-left"
            additionalClasses={['o-header__navigation-close-trigger']}
            tabIndex={-1}
            aria-label="sub menu trigger"
          />
          <li className="o-header__navigation-sub-level-item o-header__navigation-sub-level-item-overview">
            <Link
              level="simple"
              label={`${label} overview`}
              href={href}
              additionalClasses={['o-header__navigation-trigger']}
              tabIndex={-1}
            />
          </li>
          {subNavigation.map((subEntry, index) => (
            <li key={index} className="o-header__navigation-sub-level-item">
              <NavigationItem entry={subEntry} level={level + 1} />
            </li>
          ))}
        </ul>
      </>
    )}
  </>
);

const Navigation: React.FunctionComponent<NavigationProps> = ({
  navigation = [],
  languages = [],
}) => (
  <nav className="o-header__navigation" aria-label="Main navigation">
    <ul className="o-header__navigation-first-level" role="menu">
      {navigation.map((entry) => (
        <li key={entry.label} className="o-header__navigation-first-level-item">
          <NavigationItem entry={entry} />
        </li>
      ))}
      <li key="language-selector" className="o-header__language-selector">
        <LanguageSelector languages={languages} />
      </li>
    </ul>
  </nav>
);

export { Navigation };
export type { NavigationProps, NavigationEntry };
