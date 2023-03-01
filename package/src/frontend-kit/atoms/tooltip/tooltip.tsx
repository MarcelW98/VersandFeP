import * as React from 'react';
import classNames from 'classnames';

class TooltipProps {
  content: string;
  width?: 'dynamic' | 'fixed';
  type?: 'success' | 'error' | 'warning';
}

/**
 * @name      a-tooltip
 * @type      atom
 * @author    Experience One AG
 * @copyright Robert Bosch GmbH
 *
 * @param   {content} string   content of the tooltip
 * @param   {width} string     width modifier (dynamic or fixed)
 * @param   {type} string      success, error or warning variant
 */

const Tooltip: React.FunctionComponent<TooltipProps> = ({
  content,
  width = null,
  type = null,
}: TooltipProps) => {
  const tooltipClass = classNames(
    'a-tooltip',
    {
      [`a-tooltip--${type}`]: type,
      [`-${width}-width`]: width,
    },
    '-floating',
  );

  return (
    <span className={tooltipClass} role="tooltip">
      {content}
    </span>
  );
};

export { Tooltip, TooltipProps };
