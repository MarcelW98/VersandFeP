import * as React from 'react';

import { Background } from '../background';

const DimmedBackgroundDemonstrator: React.FunctionComponent = () => (
  <div style={{ position: 'relative' }}>
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    demo background text for dimmed background
    <br />
    <div style={{ position: 'absolute', top: 0 }}>
      <Background type="dimmed" />
    </div>
  </div>
);

export default DimmedBackgroundDemonstrator;
