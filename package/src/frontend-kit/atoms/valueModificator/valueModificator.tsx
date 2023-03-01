import classNames from 'classnames';
import * as React from 'react';

interface ValueModificatorProps {
  disabled?: boolean;
  id: string;
  label?: string;
}

/**
 * @name        a-value-modificator
 * @type        atom
 *
 * @param       disabled        Whether or not the value modificator is disabled
 * @param       id              Unique ID for the value modificator
 * @param       label           Label of value modificator

 * @description
 * representation of value modificator
 */

const ValueModificator: React.FunctionComponent<ValueModificatorProps> = ({
  disabled,
  id,
  label,
}: ValueModificatorProps) => {
  const divClass = classNames(
    'a-value-modificator',
    { '-disabled': disabled },
  );

  return (
    <div className={divClass}>
      {label && <label htmlFor={id}>{label}</label>}
      <input
        type="number"
        min="0"
        max="100"
        step="5"
        id={id}
        disabled={disabled}
      />
      <i
        className="a-icon a-value-modificator__icon a-value-modificator__minus-icon boschicon-bosch-ic-less-minimize"
        title="LoremIpsum"
      />
      <i
        className="a-icon a-value-modificator__icon a-value-modificator__plus-icon boschicon-bosch-ic-add"
        title="LoremIpsum"
      />
    </div>
  );
};

export { ValueModificator };
export type { ValueModificatorProps };
