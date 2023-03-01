import * as React from 'react';
import classNames from 'classnames';

class ProgressIndicatorProps {
  name?: string;
  type: string;
  progressId?: string;
  progress?: number;
}

/**
 * @name        a-progress-indicator
 * @type        atom
 *
 * @param       name          Variant's name. Optional.
 * @param       type          Type of indicator. Either determinate or indeterminate
 * @param       progressId    identifier for a determinate progress indicator
 * @param       progress      Progress of the indicator
 *
 * @description
 * representation of a progress indicator
 */

const ProgressIndicator: React.FunctionComponent<ProgressIndicatorProps> = ({
  name,
  type,
  progressId,
  progress,
}: ProgressIndicatorProps) => {
  const progressIndicatorTypeClass = classNames('a-progress-indicator', {
    [`-${type}`]: type,
  });
  const progressValue: number = progress != null ? progress : 0;
  const progressStyle = { width: `${progressValue}%` };
  if (type === 'determinate') {
    return (
      <div
        className={progressIndicatorTypeClass}
        id={progressId}
        role="progressbar"
        aria-label={`progress-bar-${name ? name.replace(/\s/g, '-') : null}`}
      >
        <div
          className="a-progress-indicator__inner-bar"
          style={progressStyle}
        />
      </div>
    );
  }
  return (
    <div
      className={progressIndicatorTypeClass}
      role="progressbar"
      aria-label="progress-bar-indeterminate"
    >
      <div className="a-progress-indicator__anim-bar">
        <div className="a-progress-indicator__inner-bar" />
      </div>
    </div>
  );
};

export { ProgressIndicator, ProgressIndicatorProps };
