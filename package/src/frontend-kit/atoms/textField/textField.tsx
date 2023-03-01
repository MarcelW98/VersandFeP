/* eslint-disable jsx-a11y/tabindex-no-positive */
import classNames from 'classnames';
import * as React from 'react';
import { Icon } from '../icon/icon';

interface TextfieldProps {
  withReset?: boolean;
  disabled?: boolean;
  id: string;
  placeholder?: string;
  label?: string;
  type?: 'text' | 'search' | 'password';
}

/**
 * @name        a-text-field
 * @type        atom
 * @author      Experience One AG
 * @copyright   Robert Bosch GmbH
 *
 * @param       withReset       Wether or not the close icon is shown
 * @param       disabled        Wether or not the text field is disabled
 * @param       id              Unique ID for the text field
 * @param       placeholder     Placeholder of text field
 * @param       label           Label of text field
 * @param       isPassword      Wether or not the text field is a password field

 * @description
 * representation of text field
 */

const TextField: React.FunctionComponent<TextfieldProps> = ({
  withReset,
  disabled,
  id,
  placeholder,
  label,
  type = 'text',
}: TextfieldProps) => {
  const isSearch = type === 'search';
  const isPassword = type === 'password';

  const divClass = classNames(
    'a-text-field',
    { 'a-text-field--password': isPassword },
    { 'a-text-field--search': isSearch },
  );

  return (
    <div className={divClass}>
      {label && <label htmlFor={id}>{label}</label>}
      <input
        type={type}
        id={id}
        disabled={disabled}
        placeholder={placeholder}
      />
      {isPassword && (
        <button type="button" className="a-text-field__icon-password">
          <Icon isUiIcon titleText="LoremIpsum" iconName="watch-on" />
        </button>
      )}
      {isSearch && (
        <>
          <button type="submit" className="a-text-field__icon-search">
            <Icon isUiIcon titleText="LoremIpsum" iconName="search" />
          </button>
          {withReset && (
            <button type="button" className="a-text-field__icon-close">
              <Icon isUiIcon titleText="LoremIpsum" iconName="close-small" />
            </button>
          )}
        </>
      )}
    </div>
  );
};

export { TextField };
export type { TextfieldProps };
