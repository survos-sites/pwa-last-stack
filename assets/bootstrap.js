import { startStimulusApp } from '@symfony/stimulus-bundle';
import Timeago from 'stimulus-timeago'

const app = startStimulusApp();
app.debug=false;
app.register('timeago', Timeago);
