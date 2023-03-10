import * as React from 'react';

class VideoProps {
  sources: {
    type: 'mp4' | 'webm' | 'ogv';
    src: string;
  }[];
  caption?: {
    caption: string[];
  }[];
}

/**
 * @name    a-video
 * @type    atom
 * @author Experience One AG
 * @copyright Robert Bosch GmbH
 * @param   {string} caption  Caption of Video
 * @param   {array} source    Array of Source-Objects
 * @description
 * representation of video elements
 */
const Video: React.FunctionComponent<VideoProps> = ({
  caption,
  sources,
}: VideoProps) => {
  return (
    <div className="a-video">
      <video controls>
        {sources.map((source) => {
          // const key = (index * Math.random() * 1000).toFixed(0);
          return (
            <source key="100" src={source.src} type={`video/${source.type}`} />
          );
        })}
        <track src="#" kind="captions" srcLang="en" label="english_captions" />
      </video>
      {caption && <div className="a-video__caption">{caption}</div>}
    </div>
  );
};

export { Video, VideoProps };
