import { startStimulusApp } from '@symfony/stimulus-bundle';
import Timeago from 'stimulus-timeago'

const app = startStimulusApp();
app.debug=true;
app.register('timeago', Timeago);
