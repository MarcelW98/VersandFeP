import * as React from 'react';
import { Button } from '../../atoms/button/button';
import { Link } from '../../atoms/link/link';
import {
  SearchSuggestions,
  Suggestion,
} from '../../atoms/searchSuggestions/searchSuggestions';
import Logo from './parts/logo';
import MenuTrigger from './parts/menuTrigger';
import { Navigation, NavigationEntry } from './parts/navigation';
import Search from './parts/search';

interface Quicklink {
  label: string;
  icon: string;
}

export interface HeaderProps {
  quicklinks?: Quicklink[];
  includeSearch?: boolean;
  searchSuggestions?: Suggestion[];
  breadcrumbs?: string[];
  subbrand?: string;
  navigation: NavigationEntry[];
  languages?: string[];
}

/**
 *
 * @name o-header
 * @type organism
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param {Quicklink[]} quicklinks          Optional quicklinks to display.
 * @param {boolean} includeSearch           Whether or not to include the search.
 * @param {Suggestion[]} searchSuggestions  Optional search suggestions to display.
 * @param {string[]} breadcrumbs            Optional breadcrumbs to display.
 * @param {string} subbrand                 Optional subbrand to display.
 * @param {NavigationEntry[]} navigation    Navigation container to display.
 * @param {string[]} languages              Optional languagues from a Dropdown to display.
 *
 * @description
 * representation of header
 */

const Header: React.FunctionComponent<HeaderProps> = ({
  quicklinks = [],
  includeSearch = false,
  searchSuggestions = [],
  breadcrumbs = [],
  subbrand,
  navigation = [],
  languages = [],
}) => (
  <header className="o-header">
    <div className="o-header__top-container">
      <div className="e-container">
        <div className="o-header__top">
          <Logo />
          <div className="o-header__quicklinks">
            {quicklinks.map((quicklink) => (
              <Button
                key={quicklink.label}
                mode="integrated"
                label={quicklink.label}
                icon={quicklink.icon}
              />
            ))}
          </div>
          {includeSearch && <Search />}
          <MenuTrigger />
        </div>
      </div>
    </div>

    <div className="o-header__search_suggestions_container">
      <div className=" e-container">
        {includeSearch && searchSuggestions.length > 0 && (
          <SearchSuggestions suggestions={searchSuggestions} />
        )}
      </div>
    </div>

    <div className="e-container">
      <div className="o-header__meta">
        {breadcrumbs.length > 0 && (
          <ol className="o-header__breadcrumbs">
            {breadcrumbs.map((breadcrumb, index, list) => (
              <li
                key={breadcrumb}
                aria-current={index === list.length - 1 ? 'page' : null}
              >
                <Link level="primary" label={breadcrumb} href="/" />
              </li>
            ))}
          </ol>
        )}
        {subbrand && (
          <span className="o-header__subbrand">Subbrand identifier</span>
        )}
      </div>
    </div>

    <div className="o-header__navigation-container">
      <div className="e-container">
        <Navigation navigation={navigation} languages={languages} />
      </div>
    </div>
  </header>
);

export default Header;
