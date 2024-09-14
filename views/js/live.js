const hash = location.hash;

let urlOption = null;

if (hash) {
    urlOption = JSON.parse(decodeURIComponent(hash.replace('#', '')));
}

let playerOption = {
    autoStart: true,
    autoFallback: true,
    mute: false,
    sources: [{
        "type": "ll-hls",
        "file": "http://play.hardgames.com.ar:3333/app/stream/llhls.m3u8"}],
    hlsConfig: {
        "liveSyncDuration": 1.5,
        "liveMaxLatencyDuration": 3,
        "maxLiveSyncPlaybackRate": 1.5},
    showBigPlayButton: true
};

if (urlOption && urlOption.playerOption) {

    playerOption = _.extend(playerOption, urlOption.playerOption);
}

let demoOption = {
    autoReload: true,
    autoReloadInterval: 2000
};

if (urlOption && urlOption.demoOption) {

    demoOption = _.extend(demoOption, urlOption.demoOption);
}

function makeCopyButton(element) {

    const tooltip = new mdb.Tooltip(element, {
        placement: 'bottom',
        title: 'copied!',
        trigger: 'manual'
    });

    tooltip.timer = null;

    const clipboard = new ClipboardJS(element);

    clipboard.on('success', function () {

        if (tooltip.timer) {
            clearTimeout(tooltip.timer);
        }

        tooltip.show();

        tooltip.timer = setTimeout(function () {
            tooltip.hide();
        }, 1000);
    });
}

function LoadPlayerData(){

    console.log("entro en setUrl!!");

            const url = "http://play.hardgames.com.ar:3333/app/stream/llhls.m3u8";

            let protocol = null;

            if (url.indexOf('ws:') === 0 || url.indexOf('wss:') === 0) {

                protocol = "webrtc";
            } else if (url.indexOf('http:') === 0 || url.indexOf('https:') === 0) {

                if (url.indexOf('.m3u8') > 0) {

                    protocol = "hls";

                    if (url.endsWith('llhls.m3u8')) {
                        protocol = 'll-hls'
                    }
                } else if (url.indexOf('.mpd') > 0) {

                    protocol = "dash";
                } else if (url.indexOf('.mp4') > 0) {

                    protocol = "http";
                }
            }

            if (!protocol) {

                this.unLoadPlayer();
                this.playerMessage = "Invalid playback url";

                return;
            }

            const source = {
                type: protocol,
                file: url
            };

            playerOption.sources.push(source);

            app.methods.reloadPlayer;

}
const app = {
    data: function () {
        return {
            reloadTimer: null,
            player: null,
            source: null,
            loadButtonMsg: 'LOAD PLAYER',
            loadButtonColor: 'btn-primary',
            loadButtonIcon: 'fa-play',
            playerMessage: null,
            playerOption: playerOption,
            demoOption: demoOption,
            permanentLink: location.href,
            createScript: null,
            createScriptHTML: null,
            playerVersion: null
        }
    },
    methods: {
        setUrl: function (){

            console.log("entro en setUrl!!");

            const url = "http://play.hardgames.com.ar:3333/app/stream/llhls.m3u8";

            let protocol = null;

            if (url.indexOf('ws:') === 0 || url.indexOf('wss:') === 0) {

                protocol = "webrtc";
            } else if (url.indexOf('http:') === 0 || url.indexOf('https:') === 0) {

                if (url.indexOf('.m3u8') > 0) {

                    protocol = "hls";

                    if (url.endsWith('llhls.m3u8')) {
                        protocol = 'll-hls'
                    }
                } else if (url.indexOf('.mpd') > 0) {

                    protocol = "dash";
                } else if (url.indexOf('.mp4') > 0) {

                    protocol = "http";
                }
            }

            if (!protocol) {

                this.unLoadPlayer();
                this.playerMessage = "Invalid playback url";

                return;
            }

            const source = {
                type: protocol,
                file: url
            };

            this.playerOption.sources.push(source);
            
        },
        addSource: function () {

            if (!this.source) {
                return;
            }

            const url = this.source.trim();

            let protocol = null;

            if (url.indexOf('ws:') === 0 || url.indexOf('wss:') === 0) {

                protocol = "webrtc";
            } else if (url.indexOf('http:') === 0 || url.indexOf('https:') === 0) {

                if (url.indexOf('.m3u8') > 0) {

                    protocol = "hls";

                    if (url.endsWith('llhls.m3u8')) {
                        protocol = 'll-hls'
                    }
                } else if (url.indexOf('.mpd') > 0) {

                    protocol = "dash";
                } else if (url.indexOf('.mp4') > 0) {

                    protocol = "http";
                }
            }

            if (!protocol) {

                this.unLoadPlayer();
                this.playerMessage = "Invalid playback url";

                return;
            }

            const source = {
                type: protocol,
                file: url
            };

            this.playerOption.sources.push(source);
            this.source = null;

            this.unLoadPlayer(true);
            this.makePermanentLink();
        },
        removeSource: function (index) {

            this.playerOption.sources.splice(index, 1);

            this.unLoadPlayer(true);
            this.makePermanentLink();
        },
        loadPlayer: function () {

            if (this.player) {
                this.player.remove();
                this.player = null;
            }

            if (this.playerOption.sources.length === 0) {
                this.playerMessage = 'Please add the playback sources.';
                return;
            }

            const playerOption = JSON.parse(JSON.stringify(this.playerOption));

            this.player = OvenPlayer.create('player', playerOption);

            this.playerVersion = this.player.getVersion();

            this.player.on('ready', function () {
                vm.loadButtonMsg = 'UNLOAD PLAYER';
                vm.loadButtonColor = 'btn-success';
                vm.loadButtonIcon = 'fa-stop';
                vm.playerMessage = null;
            });

            if (this.demoOption.autoReload && this.demoOption.autoReloadInterval > 0) {

                this.player.once('error', function (e) {

                    console.log(e);

                    if (this.reloadTimer) {
                        clearInterval(this.reloadTimer);
                        this.reloadTimer = null;
                    }

                    vm.reloadTimer = setTimeout(function () {

                        vm.unLoadPlayer();
                        vm.loadPlayer();
                    }, vm.demoOption.autoReloadInterval);
                });
            }
        },
        unLoadPlayer: function (optionChanged) {

            if (this.reloadTimer) {
                clearInterval(this.reloadTimer);
                this.reloadTimer = null;
            }

            if (this.player) {

                this.player.remove();
                this.player = null;
                this.loadButtonMsg = 'LOAD PLAYER';
                this.loadButtonColor = 'btn-primary';
                this.loadButtonIcon = 'fa-play';
            }

            if (optionChanged) {
                this.playerMessage = 'The options have changed. Please reload the player.';
            }
        },
        reloadPlayer: function () {

            if (this.player) {

                this.unLoadPlayer();
            } else {

                this.loadPlayer();
            }
        },
        makePermanentLink: function () {

            const link = {};
            link.playerOption = this.playerOption;
            link.demoOption = this.demoOption;

            location.hash = encodeURIComponent(JSON.stringify(link));
            this.permanentLink = location.href;

            let script = 'const player = OvenPlayer.create("player_el_id", '
                + JSON.stringify(this.playerOption) + ');';
            this.createScript = js_beautify(script);
            this.createScriptHTML = hljs.highlight(this.createScript, {
                language: 'javascript'
            }).value;
        },
        changeOptions: function () {

            this.unLoadPlayer(true);
            this.makePermanentLink();
        }
    },
    computed: {
        playoutDelayHintCheck: {
            get: function () {

                if (this.playerOption.webrtcConfig &&
                    this.playerOption.webrtcConfig.playoutDelayHint > -1) {

                    return true;
                } else {
                    return false;
                }
            },
            set: function (value) {

                if (value) {
                    if (!this.playerOption.webrtcConfig) {
                        this.playerOption.webrtcConfig = {};
                    }
                    this.playerOption.webrtcConfig.playoutDelayHint = 3;
                } else {
                    delete this.playerOption.webrtcConfig.playoutDelayHint;

                    if (_.isEmpty(this.playerOption.webrtcConfig)) {

                        delete this.playerOption.webrtcConfig;
                    }
                }

                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        playoutDelayHintInput: {
            get: function () {

                if (this.playoutDelayHintCheck) {

                    return this.playerOption.webrtcConfig.playoutDelayHint;
                }
            },
            set: function (value) {
                if (value > 0) {

                    this.playerOption.webrtcConfig.playoutDelayHint = value;
                    this.unLoadPlayer(true);
                    this.makePermanentLink();
                }
            }
        },
        reloadOnConnectionTimeoutCheck: {
            get: function () {

                if (this.playerOption.webrtcConfig &&
                    (_.isNumber(this.playerOption.webrtcConfig.connectionTimeout)
                        || _.isNumber(this.playerOption.webrtcConfig.timeoutMaxRetry))) {

                    return true;
                } else {
                    return false;
                }
            },
            set: function (value) {

                if (value) {
                    if (!this.playerOption.webrtcConfig) {
                        this.playerOption.webrtcConfig = {};
                    }
                    this.playerOption.webrtcConfig.timeoutMaxRetry = 4;
                    this.playerOption.webrtcConfig.connectionTimeout = 10000;
                } else {

                    delete this.playerOption.webrtcConfig.timeoutMaxRetry;
                    delete this.playerOption.webrtcConfig.connectionTimeout;

                    if (_.isEmpty(this.playerOption.webrtcConfig)) {

                        delete this.playerOption.webrtcConfig;
                    }
                }

                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        webrtcLoadingRetryCount: {
            get: function () {

                if (this.playerOption.webrtcConfig &&
                    _.isNumber(this.playerOption.webrtcConfig.timeoutMaxRetry)) {

                    return this.playerOption.webrtcConfig.timeoutMaxRetry;
                }
            },
            set: function (value) {
                if (!this.playerOption.webrtcConfig) {
                    this.playerOption.webrtcConfig = {};
                }

                this.playerOption.webrtcConfig.timeoutMaxRetry = value;
                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        webrtcLoadingTimeout: {
            get: function () {

                if (this.playerOption.webrtcConfig &&
                    _.isNumber(this.playerOption.webrtcConfig.connectionTimeout)) {

                    return this.playerOption.webrtcConfig.connectionTimeout;
                }
            },
            set: function (value) {
                if (!this.playerOption.webrtcConfig) {
                    this.playerOption.webrtcConfig = {};
                }

                this.playerOption.webrtcConfig.connectionTimeout = value;
                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        llDashCheck: {
            get: function () {

                let value = false;

                if (this.playerOption &&
                    this.playerOption.sources) {

                    _.each(this.playerOption.sources, function (source) {

                        if (source.type === 'dash' && source.lowLatency === true) {

                            value = true;
                            return;
                        }
                    });
                }

                return value;
            },
            set: function (value) {

                if (this.playerOption &&
                    this.playerOption.sources) {

                    _.each(this.playerOption.sources, function (source) {

                        if (source.type === 'dash') {

                            if (value) {
                                source.lowLatency = true;
                            } else {
                                delete source.lowLatency;
                            }
                        }
                    });

                    if (!value) {

                        if (this.playerOption.lowLatencyMpdLiveDelay) {

                            delete this.playerOption.lowLatencyMpdLiveDelay;
                        }
                    }

                    this.unLoadPlayer(true);
                    this.makePermanentLink();
                }
            }
        },
        llDashLiveDelay: {
            get: function () {

                if (this.playerOption.lowLatencyMpdLiveDelay &&
                    _.isNumber(this.playerOption.lowLatencyMpdLiveDelay)) {

                    return this.playerOption.lowLatencyMpdLiveDelay;
                }
            },
            set: function (value) {

                if (value) {

                    this.playerOption.lowLatencyMpdLiveDelay = value;

                } else {

                    delete this.playerOption.lowLatencyMpdLiveDelay;
                }

                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        hlsManageLatencyCheck: {
            get: function () {

                if (this.playerOption.hlsConfig &&
                    (_.isNumber(this.playerOption.hlsConfig.liveSyncDuration)
                        || _.isNumber(this.playerOption.hlsConfig.liveMaxLatencyDuration)
                        || _.isNumber(this.playerOption.hlsConfig.maxLiveSyncPlaybackRate))) {

                    return true;
                } else {
                    return false;
                }
            },
            set: function (value) {

                if (value) {
                    if (!this.playerOption.hlsConfig) {
                        this.playerOption.hlsConfig = {};
                    }
                    this.playerOption.hlsConfig.liveSyncDuration = 1.5;
                    this.playerOption.hlsConfig.liveMaxLatencyDuration = 3;
                    this.playerOption.hlsConfig.maxLiveSyncPlaybackRate = 1.5;
                } else {

                    delete this.playerOption.hlsConfig.liveSyncDuration;
                    delete this.playerOption.hlsConfig.liveMaxLatencyDuration;
                    delete this.playerOption.hlsConfig.maxLiveSyncPlaybackRate;

                    if (_.isEmpty(this.playerOption.hlsConfig)) {

                        delete this.playerOption.hlsConfig;
                    }
                }

                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        hlsTargetLatency: {
            get: function () {

                if (this.playerOption.hlsConfig &&
                    _.isNumber(this.playerOption.hlsConfig.liveSyncDuration)) {

                    return this.playerOption.hlsConfig.liveSyncDuration;
                }
            },
            set: function (value) {
                if (!this.playerOption.hlsConfig) {
                    this.playerOption.hlsConfig = {};
                }

                this.playerOption.hlsConfig.liveSyncDuration = value;
                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        hlsMaxLatency: {
            get: function () {

                if (this.playerOption.hlsConfig &&
                    _.isNumber(this.playerOption.hlsConfig.liveMaxLatencyDuration)) {

                    return this.playerOption.hlsConfig.liveMaxLatencyDuration;
                }
            },
            set: function (value) {
                if (!this.playerOption.hlsConfig) {
                    this.playerOption.hlsConfig = {};
                }

                this.playerOption.hlsConfig.liveMaxLatencyDuration = value;
                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        },
        hlsLiveSyncCatchupRate: {
            get: function () {

                if (this.playerOption.hlsConfig &&
                    _.isNumber(this.playerOption.hlsConfig.maxLiveSyncPlaybackRate)) {

                    return this.playerOption.hlsConfig.maxLiveSyncPlaybackRate;
                }
            },
            set: function (value) {
                if (!this.playerOption.hlsConfig) {
                    this.playerOption.hlsConfig = {};
                }

                this.playerOption.hlsConfig.maxLiveSyncPlaybackRate = value;
                this.unLoadPlayer(true);
                this.makePermanentLink();
            }
        }

    },
    mounted: function () {

        this.loadPlayer();

        if (urlOption) {
            this.makePermanentLink();
        }

        makeCopyButton(this.$refs.copyCodeButton);
        makeCopyButton(this.$refs.exportButton);
    }
};

const demo = Vue.createApp(app);

demo.component('source-item', {
    props: ['source', 'index'],
    emits: ['removeSource'],
    template: document.getElementById('source-item').innerText,
    mounted: function () {
        makeCopyButton(this.$refs.copyButton);
    }
});

const vm = demo.mount('#app');