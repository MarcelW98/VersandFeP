import * as React from 'react';
import classNames from 'classnames';

class SliderProps {
  disabled?: boolean;
  id: string;
  min?: number;
  max?: number;
  step?: number;
  labelLeft?: string;
  labelRight?: string;
  tooltip?: boolean;
  tooltipType?: string;
  tooltipUnit?: string;
  labelsOnTop?: boolean;
}

/**
 * @name        a-slider
 * @type        atom
 *
 * @param       disabled        Whether or not the slider is disabled
 * @param       id              Unique ID for the slider
 * @param       min             Minimum value of slider
 * @param       max             Maximum value of slider
 * @param       step            The interval the value moves on every step
 * @param       labelLeft       Label text at the left sight of the slider
 * @param       labelRight      Label text at the right side of the textfield
 * @param       tooltip         Whether a tooltip with the value is displayed on click of the thumb
 * @param       tooltipType     Can be absolute or relative. Relative by default
 * @param       tooltipUnit     Unit symbol, displayed with absolute value
 * @param       labelsOnTop     if true, labels will be displayed on top instead of
 *                              to the sides, optional, defaults to false
 * @description
 * representation of a slider
 */

const Slider: React.FunctionComponent<SliderProps> = ({
  disabled,
  id,
  min = 0,
  max = 100,
  step = 1,
  labelLeft,
  labelRight,
  tooltip,
  tooltipType,
  tooltipUnit,
  labelsOnTop = false,
}: SliderProps) => {
  const divClass = classNames('a-slider', {
    'a-slider--labels-on-top': labelsOnTop,
  });

  const inputElement = (
    <input
      id={id}
      type="range"
      min={min}
      max={max}
      step={step}
      disabled={disabled}
    />
  );

  return (
    <div className={divClass}>
      {labelLeft && <label htmlFor={id}>{labelLeft}</label>}
      {tooltip && (
        <div>
          <span
            className="a-tooltip"
            tooltip-type={tooltipType === 'absolute' ? 'absolute' : 'relative'}
            tooltip-unit={tooltipUnit}
          />
          {inputElement}
        </div>
      )}
      {!tooltip && inputElement}

      {labelRight && <label htmlFor={id}>{labelRight}</label>}
    </div>
  );
};

export { Slider, SliderProps };
