import * as React from 'react';
import { StepIndicator, StepIndicatorProps } from '../stepIndicator';
import { Button } from '../../../atoms/button/button';

/* eslint-disable react/jsx-props-no-spreading */
const StepIndicatorIconsOnlyDemonstrator: React.FunctionComponent<StepIndicatorProps> = ({
  ...data
}) => {
  const controlsStyles = {
    display: 'flex',
    justifyContent: 'space-between',
    marginTop: '1rem',
  };

  return (
    <div className="frontend-kit-example__step-indicator-example">
      <StepIndicator {...data} />
      <div className="step-indicator__controls" style={controlsStyles}>
        <Button
          mode="secondary"
          label="Previous step"
          additionalClasses={['step-indicator__prev']}
        />
        <Button
          label="Next step"
          additionalClasses={['step-indicator__next']}
        />
      </div>
    </div>
  );
};
export default StepIndicatorIconsOnlyDemonstrator;
