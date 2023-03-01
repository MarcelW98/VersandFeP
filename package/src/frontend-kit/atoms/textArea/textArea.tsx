import classNames from 'classnames';
import * as React from 'react';

interface TextAreaProps {
  disabled?: boolean;
  id: string;
  placeholder?: string;
  dynamicHeight?: boolean;
  label?: string;
}

/**
 * @name        a-text-area
 * @type        atom
 * @author      Experience One AG
 * @copyright   Robert Bosch GmbH
 *
 * @param       disabled      Wether or not the text area is disabled
 * @param       id              Unique ID for the text area
 * @param       placeholder     Placeholder of text area
 * @param       dynamicHeight    Wether or not the text area has a dynamic height
 * @param       label           Label of text area
 *
 * @description
 * representation of text area
 */

const TextArea: React.FunctionComponent<TextAreaProps> = ({
  disabled,
  id,
  placeholder,
  dynamicHeight,
  label,
}: TextAreaProps) => {
  const inputClass = classNames('a-text-area', {
    [`a-text-area--dynamic-height`]: dynamicHeight,
  });

  return (
    <div className={inputClass}>
      {label && <label htmlFor={id}>{label}</label>}
      <textarea id={id} disabled={disabled} placeholder={placeholder} />
      {dynamicHeight && <div className="a-text-area__shadow" />}
    </div>
  );
};

export { TextArea };
export type { TextAreaProps };
