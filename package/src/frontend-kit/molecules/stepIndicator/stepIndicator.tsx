import classNames from 'classnames';
import * as React from 'react';
import { Icon } from '../../atoms/icon/icon';



interface StepIndicatorProps {
  items: {
    id: number;
    content?: string;
    label?: string;
    iconName?: string;
  }[];
  withoutContent?: boolean;
}

const StepIndicator: React.FunctionComponent<StepIndicatorProps> = ({
  items,
  withoutContent,
}) => {
  const stepIndicatorClasses = classNames('m-step-indicator', {
    '-small': withoutContent,
  });

  return (
    <div className={stepIndicatorClasses}>
      <ul className="m-step-indicator__steps">
        {items.map(({ id, content, label, iconName }) => (
          <li
            className={`m-step-indicator__step ${id === 1 ? '-active' : ''}`}
            key={`step-${id}`}
          >
            <div className="m-step-indicator__node">
              {content && content}
              {iconName && <Icon iconName={iconName} titleText={label} />}
            </div>
            {label && <span className="m-step-indicator__label">{label}</span>}
          </li>
        ))}
      </ul>
    </div>
  );
};

export { StepIndicator };
export type { StepIndicatorProps };
