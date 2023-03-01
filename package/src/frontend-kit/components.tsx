/**
 * This file contains every given component
 * It is used as the main file to import components from
 * and to include a component inside an other one
 */

// Basics
import { Layout } from './basics/styles/layout/layout';
import { Typography } from './basics/styles/typography/typography';

// Atoms
import { Accordion } from './atoms/accordion/accordion';
import { Text } from './atoms/text/text';
import { Image } from './atoms/image/image';
import { Link } from './atoms/link/link';
import { Background } from './atoms/background/background';
import { Badge } from './atoms/badge/badge';
import { Button } from './atoms/button/button';
import { RadioButton } from './atoms/radioButton/radioButton';
import { Chip } from './atoms/chip/chip';
import { ActivityIndicator } from './atoms/activityIndicator/activityIndicator';
import { Toggle } from './atoms/toggle/toggle';
import { List } from './atoms/list/list';
import { Checkbox } from './atoms/checkbox/checkbox';
import { Divider } from './atoms/divider/divider';
import { Tooltip } from './atoms/tooltip/tooltip';
import { MenuItem } from './atoms/menuItem/menuItem';
// import { Pin } from './atoms/pin/pin';
import { PageIndicator } from './atoms/pageIndicator/pageIndicator';
import { Box } from './atoms/box/box';
import { TextField } from './atoms/textField/textField';
import { TextArea } from './atoms/textArea/textArea';
import { Video } from './atoms/video/video';
import { Icon } from './atoms/icon/icon';
import { Notification } from './atoms/notification/notification';
import { Dropdown } from './atoms/dropdown/dropdown';
import { ProgressIndicator } from './atoms/progressIndicator/progressIndicator';
import { Rating } from './atoms/rating/rating';
import { Slider } from './atoms/slider/slider';
import { Sticker } from './atoms/sticker/sticker';
import { TableCell } from './atoms/tableCell/tableCell';
import { Tile } from './atoms/tile/tile';
import { SelectableTile } from './atoms/selectableTile/selectableTile';
import { ValueModificator } from './atoms/valueModificator/valueModificator';
import { SearchSuggestions } from './atoms/searchSuggestions/searchSuggestions';
import { TabNavigation } from './atoms/tabNavigation/tabNavigation';
import { OptionBar } from './atoms/optionBar/optionBar';

// Molecules
import { TextImage } from './molecules/textImage/textImage';
import { Dialog } from './molecules/dialog/dialog';
import { Popover } from './molecules/popover/popover';
import { FormField } from './molecules/formField/formField';
import { Table } from './molecules/table/table';
import { Lightbox } from './molecules/lightbox/lightbox';
import { SearchForm } from './molecules/searchForm/searchForm';
import { LanguageSelector } from './molecules/languageSelector/languageSelector';
import { SideNavigation } from './molecules/sideNavigation/sideNavigation';
import { StepIndicator } from './molecules/stepIndicator/stepIndicator';

// Organisms
import { Form } from './organisms/form/form';
import Header from './organisms/header/header';
import { Footer } from './organisms/footer/footer';
import MinimalHeader from './organisms/minimalHeader/minimalHeader';
import { ContextMenu } from './organisms/contextMenu/contextMenu';

// Demonstrators
import MultiAccordionDemonstrator from './atoms/accordion/demonstrators/multiAccordion';
import BadgeIconDemonstrator from './atoms/badge/demonstrator/badgeIcon';
import BadgeInlineDemonstrator from './atoms/badge/demonstrator/badgeInline';
import InlineLinkDemonstrator from './atoms/link/demonstrators/inlineLink';
import LinkWithLineBreaksDemonstrator from './atoms/link/demonstrators/linkWithLineBreaks';
import DimmedBackgroundDemonstrator from './atoms/background/demonstrators/dimmedBackground';
import ModalBoxDemonstrator from './atoms/box/demonstrators/modalBox';
import DivDemonstrator from './atoms/divider/demonstrators/div';
import AllIconsDemonstrator from './atoms/icon/demonstrators/allIcons';
import UiIconsDemonstrator from './atoms/icon/demonstrators/uiIcons';
import MultilineCheckboxDemonstrator from './atoms/checkbox/demonstrators/multilineCheckbox';
import BannerNotificationDemonstrator from './atoms/notification/demonstrators/bannerNotification';
import ProgressExampleDemonstrator from './atoms/progressIndicator/demonstrators/progressExample';
import SimpleTabbedContentDemonstrator from './atoms/tabNavigation/demonstrators/simpleTabbedContent';
import HoveringTooltipDemonstrator from './atoms/tooltip/demonstrators/hoveringTooltipDemonstrator';
import TileDemonstrator from './atoms/tile/demonstrators/tileDemonstrator';

import LayoutWithImageDemonstrator from './basics/styles/layout/demonstrators/layoutWithImage';
import LayoutWithTextImageDemonstrator from './basics/styles/layout/demonstrators/layoutWithTextImage';
import LayoutWithTextImageFullWidthDemonstrator from './basics/styles/layout/demonstrators/layoutWithTextImageFullWidth';

import H1Demonstrator from './basics/styles/typography/demonstrators/h1';
import H2Demonstrator from './basics/styles/typography/demonstrators/h2';
import H3Demonstrator from './basics/styles/typography/demonstrators/h3';
import H4Demonstrator from './basics/styles/typography/demonstrators/h4';
import H5Demonstrator from './basics/styles/typography/demonstrators/h5';
import PDemonstrator from './basics/styles/typography/demonstrators/p';
import LiDemonstrator from './basics/styles/typography/demonstrators/li';
import ButtonDemonstrator from './basics/styles/typography/demonstrators/button';
import FigcaptionDemonstrator from './basics/styles/typography/demonstrators/figcaption';
import LabelDemonstrator from './basics/styles/typography/demonstrators/label';

import ModalDialogDemonstrator from './molecules/dialog/demonstrators/modalDialog';
import AttachedPopoverDemonstrator from './molecules/popover/demonstrators/attachedPopover';
import AttachedPopoverGalleryDemonstrator from './molecules/popover/demonstrators/attachedPopoverGallery';
import NotificationFormFieldDemonstrator from './molecules/formField/demonstrators/notification';
import ModalLightboxDemonstrator from './molecules/lightbox/demonstrators/modalLightbox';
import SearchAutoSuggestionsDemonstrator from './molecules/searchForm/demonstrators/suggestions';
import SideNavigationDemonstrator from './molecules/sideNavigation/demonstrators/sideNavigationDemonstrator';
import StepIndicatorDemonstrator from './molecules/stepIndicator/demonstrators/stepIndicatorDemonstrator';
import StepIndicatorIconsOnlyDemonstrator from './molecules/stepIndicator/demonstrators/stepIndicatorIconsOnlyDemonstrator';
import StepIndicatorSmallDemonstrator from './molecules/stepIndicator/demonstrators/stepIndicatorSmallDemonstrator';

import ContextMenuDemonstrator from './organisms/contextMenu/demonstrators/contextMenu';

import ExampleFormDemonstrator from './organisms/form/demonstrators/exampleForm';
import MinimalHeaderWithContentDemonstrator from './organisms/minimalHeader/demonstrators/minimalHeaderWithContent';

export {
  // BASICS
  Typography,
  Layout,
  // ATOMS
  Accordion,
  Text,
  Image,
  Link,
  Background,
  Badge,
  Button,
  RadioButton,
  Chip,
  ActivityIndicator,
  Toggle,
  List,
  Checkbox,
  Divider,
  Tooltip,
  SearchSuggestions,
  MenuItem,
  // pin,
  PageIndicator,
  ProgressIndicator,
  Dropdown,
  Video,
  Box,
  ValueModificator,
  TableCell,
  TextField,
  TextArea,
  Tile,
  SelectableTile,
  Icon,
  Rating,
  Slider,
  Sticker,
  TabNavigation,
  OptionBar,
  // ATOM DEMONSTRATORS
  SimpleTabbedContentDemonstrator,
  TileDemonstrator,
  // MOLECULES
  Popover,
  Lightbox,
  Dialog,
  TextImage,
  FormField,
  Notification,
  Table,
  SearchForm,
  LanguageSelector,
  SideNavigation,
  StepIndicator,
  // ORGANISMS
  Form,
  Header,
  Footer,
  MinimalHeader,
  ContextMenu,
  // DEMONSTRATORS
  LayoutWithImageDemonstrator,
  LayoutWithTextImageDemonstrator,
  LayoutWithTextImageFullWidthDemonstrator,
  MultiAccordionDemonstrator,
  BadgeIconDemonstrator,
  BadgeInlineDemonstrator,
  InlineLinkDemonstrator,
  LinkWithLineBreaksDemonstrator,
  DimmedBackgroundDemonstrator,
  ModalBoxDemonstrator,
  DivDemonstrator,
  H1Demonstrator,
  H2Demonstrator,
  H3Demonstrator,
  H4Demonstrator,
  H5Demonstrator,
  PDemonstrator,
  LiDemonstrator,
  ButtonDemonstrator,
  FigcaptionDemonstrator,
  LabelDemonstrator,
  AllIconsDemonstrator,
  MultilineCheckboxDemonstrator,
  UiIconsDemonstrator,
  ProgressExampleDemonstrator,
  SearchAutoSuggestionsDemonstrator,
  SideNavigationDemonstrator,
  StepIndicatorDemonstrator,
  StepIndicatorIconsOnlyDemonstrator,
  StepIndicatorSmallDemonstrator,
  // MOLECULE DEMONSTRATORS
  ModalDialogDemonstrator,
  AttachedPopoverDemonstrator,
  AttachedPopoverGalleryDemonstrator,
  NotificationFormFieldDemonstrator,
  ModalLightboxDemonstrator,
  HoveringTooltipDemonstrator,
  // ORGANISM DEMONSTRATORS
  ExampleFormDemonstrator,
  BannerNotificationDemonstrator,
  ContextMenuDemonstrator,
  MinimalHeaderWithContentDemonstrator,
};
