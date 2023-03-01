import * as React from 'react';

const hoveringTooltipDemonstrator: React.FunctionComponent = () => (
  <>
    <div
      className="frontend-kit-example__hovering-tooltip"
      data-tooltip="Hello there!"
    >
      Hover me!
    </div>

    <div
      className="frontend-kit-example__hovering-tooltip"
      data-tooltip="Hello there! This text is too long for the default width."
      data-tooltip-width="fixed"
    >
      Hover me! (fixed width)
    </div>

    <div
      className="frontend-kit-example__hovering-tooltip"
      data-tooltip="Hello there! This text is too long for the default width."
      data-tooltip-width="dynamic"
    >
      Hover me! (dynamic width)
    </div>

    <div
      className="frontend-kit-example__hovering-tooltip"
      data-tooltip="Hello there!"
      data-tooltip-type="success"
    >
      Hover me! (success variant)
    </div>
    <div
      className="frontend-kit-example__hovering-tooltip"
      data-tooltip="Hello there!"
      data-tooltip-type="warning"
    >
      Hover me! (warning variant)
    </div>
    <div
      className="frontend-kit-example__hovering-tooltip"
      data-tooltip="Hello there!"
      data-tooltip-type="error"
    >
      Hover me! (error variant)
    </div>
  </>
);
export default hoveringTooltipDemonstrator;
