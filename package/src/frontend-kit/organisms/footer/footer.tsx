import * as React from 'react';
import { Button } from '../../atoms/button/button';
import { Divider } from '../../atoms/divider/divider';
import { Link } from '../../atoms/link/link';
import { Suggestion } from '../../atoms/searchSuggestions/searchSuggestions';
import { LanguageSelector } from '../../molecules/languageSelector/languageSelector';
import { SearchForm } from '../../molecules/searchForm/searchForm';

interface FooterLink {
  label: string;
  href: string;
  isExternal?: boolean;
}

interface FooterProps {
  isMinimal?: boolean;
  claim: string;
  searchCta: string;
  topLinks: FooterLink[];
  shareOptions: string[];
  languages: string[];
  bottomLinks: FooterLink[];
  copyright: string;
  suggestions?: Suggestion[];
}

/**
 * @name      o-footer
 * @type      organism
 * @author    Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param {boolean} isMinimal               Wether or not showing the footer's minimal version.
 * @param {string} claim                    Claim to display.
 * @param {string} searchCta                Call to action for search field to display.
 * @param {FooterLink[]} topLinks           Top links to display.
 * @param {string[]} shareOptions           Sharing links to display.
 * @param {string[]} languages              Languages to choose from a dropdown.
 * @param {FooterLink[]} bottomLinks        Bottom links to display.
 * @param {string} copyright                Copyright to display.
 * @param {Suggestion[]} suggestions        Search field's suggestions to display.
 * @param {string[]} additionalLinkClasses  Additional css classes.
 *
 * @description
 * representation of Footer
 */

const additionalLinkClasses = (link: FooterLink): string[] =>
  link.isExternal ? ['-external'] : [];

const Footer: React.FunctionComponent<FooterProps> = ({
  isMinimal,
  claim,
  searchCta,
  topLinks,
  shareOptions,
  languages,
  bottomLinks,
  copyright,
  suggestions = [],
}) => (
  <footer className={`o-footer ${isMinimal ? '-minimal' : ''}`}>
    {!isMinimal && (
      <div className="o-footer__search-container -secondary">
        <div className="e-container">
          <div className="o-footer__search">
            <div className="o-footer__search-cta">{searchCta}</div>
            <SearchForm suggestions={suggestions} />
          </div>
        </div>
      </div>
    )}
    {isMinimal && <Divider />}
    <div className="e-container">
      {!isMinimal && (
        <>
          <div className="o-footer__top">
            <div className="o-footer__claim">{claim}</div>
            <LanguageSelector languages={languages} />
            <ul className="o-footer__links">
              {topLinks.map((link, index) => (
                <li key={index}>
                  <Link
                    href={link.href}
                    level="simple"
                    label={link.label}
                    additionalClasses={additionalLinkClasses(link)}
                  />
                </li>
              ))}
            </ul>
            <div className="o-footer__share">
              {shareOptions.map((option, index) => (
                <Button
                  aria-label="share button"
                  mode="integrated"
                  icon={option}
                  key={index}
                />
              ))}
            </div>
          </div>
          <Divider />
        </>
      )}
      <div className="o-footer__bottom">
        <ul className="o-footer__links">
          {bottomLinks.map((link, index) => (
            <li key={index}>
              <Link
                href={link.href}
                level="simple"
                label={link.label}
                additionalClasses={additionalLinkClasses(link)}
              />
            </li>
          ))}
        </ul>
        {isMinimal && <Divider />}
        <div className="o-footer__copyright">
          {isMinimal && (
            <i
              className="a-icon boschicon-bosch-ic-copyright-frame"
              title="Lorem Ipsum"
            />
          )}
          {copyright}
        </div>
        {!isMinimal && (
          <Button
            aria-label="button footer"
            mode="integrated"
            icon="up"
            isUiIcon
            additionalClasses={['o-footer__back-to-top']}
          />
        )}
      </div>
    </div>
  </footer>
);

export { Footer };
export type { FooterProps };
