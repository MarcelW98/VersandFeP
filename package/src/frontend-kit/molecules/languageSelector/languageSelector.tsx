// eslint-disable-next-line no-use-before-define
import * as React from 'react';
import { Dropdown } from '../../atoms/dropdown/dropdown';
import { Link } from '../../atoms/link/link';

interface LanguageSelectorProps {
  languages?: string[];
  label?: string;
}

/**
 *
 * @name      m-language-selector
 * @type      molecule
 * @author    Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param {string[]} languages  Optional languuages to display.
 * @param {string} label        Optional label to display.
 *
 * @description
 * representation of language selectors
 */

const LanguageSelector: React.FunctionComponent<LanguageSelectorProps> = ({
  label = 'Bosch Global',
  languages = [],
}) => (
  <div className="m-language-selector">
    <Link
      target="_blank"
      icon="globe"
      label={label}
      href="https://www.bosch.com/websites-worldwide/"
    />
    <Dropdown
      id="demo"
      options={languages.map((language) => ({
        name: language,
        value: language,
      }))}
    />
  </div>
);

export { LanguageSelector };
export type { LanguageSelectorProps };
