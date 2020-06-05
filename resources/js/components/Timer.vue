<template>
    <div class="d-flex justify-content-center timer">
        <div class="day">
            <span class="number">{{ days }}</span>
            <div class="format">dni</div>
        </div>
        <div class="hour">
            <span class="number">{{ hours }}</span>
            <div class="format">godzin</div>
        </div>
        <div class="min">
            <span class="number">{{ minutes }}</span>
            <div class="format">minut</div>
        </div>
        <div class="sec">
            <span class="number">{{ seconds }}</span>
            <div class="format">sekund</div>
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
            color: #240b36;

            .format {
                font-weight: 300;
                font-size: 14px;
                opacity: 0.8;
                width: 60px;
            }
        }

        .number {
            background: #240b36;
            color: #fff;
            padding: 0 5px;
            border-radius: 5px;
            display: inline-block;
            width: 60px;
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