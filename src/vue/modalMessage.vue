<template>
    <div>
        <div class="modal-message">
            <div class="modal-message__block">
                <div class="modal-message__img" :style="colorStyle">
                    {{sign}}
                </div>
                <div class="modal-message__text">
                    {{message}}
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["message", "color", "sign"],
    computed: {
        colorStyle() {
            return {
                color: this.color,
                borderColor: this.color
            }
        }
    }
}
</script>
<style lang="scss" scoped>
.modal-message {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #1c1c1c8f;
    z-index: 100;
    display: flex;
    justify-content: center;
    // padding-top: 7em;
    animation: modal .3s ease 1;
    // animation-delay: .;
    align-items: center;
    &__block {
        border-radius: 1em;
        padding: 3em;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }
    &__text {
        font-size: 2em;
        text-align: center;
        max-width: 22em;
        // font-weight: bold;
        margin-top: 1em;
    }
    &__img {
        border: 2px solid green;
        border-radius: 50%;
        height: 2em;
        width: 2em;
        display: flex;
        align-items: center;
        justify-content: center;
        color: green;
        font-size: 3em;
    }
}
@keyframes modal {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>1