import * as React from 'react';
import { Badge, BadgeProps } from '../badge';

const BadgeInlineDemonstrator: React.FunctionComponent<BadgeProps> = ({
  label,
}) => {
  return (
    <>
      <style
        /* eslint-disable-next-line react/no-danger */
        dangerouslySetInnerHTML={{
          __html: `
            .badge-inline-example {
              display: flex;
              align-items: center;
            }
          `,
        }}
      />
      <div className="badge-inline-example">
        <span>Lorem ipsum dolor sit amet.</span>
        <Badge label={label} />
      </div>
    </>
  );
};

export default BadgeInlineDemonstrator;
