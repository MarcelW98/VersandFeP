// eslint-disable-next-line no-use-before-define
import * as React from 'react';

interface TileProps {
  name: string;
  background?: 'primary' | 'secondary' | 'contrast';
  fill?: 'purple' | 'blue' | 'turquoise' | 'green';
}

/**
 * @name        a-tile
 * @type        atom
 *
 * @param       {string}  name            Tile's name.
 * @param       {string}  background      Tile's background. Optional.
 * @param       {string}  fill            Tile's fill color. Default is 'plain'. Optional.

 * @description
 * representation of tile
 */

const Tile: React.FunctionComponent<TileProps> = ({
  name,
  background = 'primary',
  fill,
  children,
}) => {
  const fillClass = fill ? `-${fill}` : '';
  const tileClass = `a-tile -${background} ${fillClass}`;

  return (
    <div className={tileClass}>
      <a
        href="/#"
        aria-label={`Link for ${name}`}
        className="a-tile__link"
        target="_blank"
      >
        {children}
      </a>
    </div>
  );
};

export { Tile, TileProps };
