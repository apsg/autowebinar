<template>
    <div class="d-flex align-items-center justify-content-center timer color-dark-blue">
        <div class="day" title="Dni">
            <span class="number">{{ days }}</span>
        </div>
        <div>
            <span class="color-dark-blue">:</span>
        </div>
        <div class="hour" title="Godzin">
            <span class="number">{{ hours }}</span>
        </div>
        <div>
            <span class="color-dark-blue">:</span>
        </div>
        <div class="min" title="Minut">
            <span class="number">{{ minutes }}</span>
        </div>
        <div>
            <span class="color-dark-blue">:</span>
        </div>
        <div class="sec" title="Sekund">
            <span class="number">{{ seconds }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Timer",

        props: ['starttime'],

        data() {
            return {
                timer: "",
                start: "",
                interval: "",
                days: "",
                minutes: "",
                hours: "",
                seconds: "",
            };
        },


        mounted() {
            this.start = new Date(this.starttime).getTime();
            // Update the count down every 1 second
            this.timerCount(this.start);
            this.interval = setInterval(() => {
                this.timerCount(this.start, this.end);
            }, 1000);
        },

        methods: {
            timerCount(start) {
                // Get todays date and time
                var now = new Date().getTime();

                var distance = start - now;

                if (distance < 0) {
                    clearInterval(this.interval);
                    window.location.reload();
                } else if (distance > 0) {
                    this.calcTime(distance);
                }
            },

            calcTime: function (dist) {
                // Time calculations for days, hours, minutes and seconds
                this.days = Math.floor(dist / (1000 * 60 * 60 * 24));
                this.hours = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                this.minutes = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                this.seconds = Math.floor((dist % (1000 * 60)) / 1000);
            }

        }
    }
</script>

<style scoped lang="scss">
    .timer {
        font-size: 20px;
        text-align: center;

        .day, .hour, .min, .sec {
            font-size: 30px;
            display: inline-block;
            font-weight: 500;
            text-align: center;
            margin: 0 5px;
            font-family: DINPro-Bold;
            line-height: 60px;

            .format {
                font-weight: 300;
                font-size: 14px;
                opacity: 0.8;
                width: 60px;
            }
        }

        .number {
            background: #fff;
            border-radius: 10px;
            display: inline-block;
            width: 60px;
            height: 60px;
            text-align: center;
        }

        .message {
            font-size: 14px;
            font-weight: 400;
            margin-top: 5px;
        }

        .status-tag {
            width: 270px;
            margin: 10px auto;
            padding: 8px 0;
            font-weight: 500;
            color: #000;
            text-align: center;
            border-radius: 15px;

            &.upcoming {
                background-color: lightGreen;
            }

            &.running {
                background-color: gold;
            }

            &.expired {
                background-color: silver;
            }
        }
    }
</style>