<template>
  <Accordion>
    <div :class="$style.answer">
      <span :class="$style.answer__label">正解</span>
      <p :class="$style.answer__text">
        {{ correctChoice.card_choice_text }}
      </p>
    </div>
    <span :class="$style.border"><!-- border --></span>
    <h3 :class="$style.comment__label">
      解説
    </h3>
    <p :class="$style.comment__text">
      {{ card.card_explanation }}
    </p>
    <img
      v-if="card.card_explanation_image"
      :src="imageUrl"
      :class="$style.image"
    >
  </Accordion>
</template>

<script>
import { mapState } from 'vuex'
import Accordion from '@/components/Accordion.vue'

export default {
  components: {
    Accordion
  },
  computed: {
    cardId () {
      return this.$route.params.cardId
    },
    choices () {
      return this.card.card_choices
    },
    correctChoice () {
      return this.choices.find(choice => {
        return choice.card_choice_is_correct === true
      })
    },
    imageUrl () {
      const url = process.env.BASE_URL_ASSETS
      const cardId = this.cardId
      const filename = this.card.card_explanation_image
      return `${url}/images/cards/${this.card.card_id}/${filename}`
    },
    ...mapState('card', ['card'])
  }
}
</script>

<style lang="scss" module>
.answer {
  display: flex;
  justify-content: flex-start;
  align-items: center;
}

.answer__label {
  $height-pc: 40px;
  $height-tb: 35px;
  $height-sp: 30px;

  width: 100px;
  height: $height-pc;
  border-radius: $height-pc / 2;
  background-color: #f6416c;
  color: #fff;
  font-size: 20px;
  font-weight: bold;
  display: flex;
  justify-content: center;
  align-items: center;

  @include mq(tb) {
    width: 90px;
    font-size: 17px;
    height: $height-tb;
    border-radius: $height-tb / 2;
  }

  @include mq(sp) {
    width: 80px;
    font-size: 14px;
    height: $height-sp;
    border-radius: $height-sp / 2;
  }
}

.answer__text {
  width: 100%;
  min-width: 0;
  margin-left: 10px;
  font-size: 16px;
  line-height: 1.5;
  font-weight: bold;

  @include mq(tb) {
    font-size: 15px;
  }

  @include mq(sp) {
    font-size: 13px;
  }
}

.border {
  display: block;
  height: 3px;
  margin: 30px 0;
  position: relative;

  @include mq(tb) {
    margin: 25px 0;
  }

  @include mq(sp) {
    margin: 20px 0;
  }
}

.border::before {
  content: '';
  background-image: linear-gradient(to right, #00b8a9, #00b8a9 5px, transparent 5px, transparent 8px);
  background-size: 8px 3px;
  background-repeat: repeat-x;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

.comment__label {
  font-weight: 18px;
  font-weight: bold;

  @include mq(tb) {
    font-size: 16px;
  }

  @include mq(sp) {
    font-weight: 14px;
  }
}

.comment__text {
  margin-top: 10px;
  line-height: 1.5;
}

.image {
  margin-top: 30px;
  max-width: 100%;

  @include mq(tb) {
    margin-top: 25px;
  }

  @include mq(sp) {
    margin-top: 20px;
  }
}
</style>