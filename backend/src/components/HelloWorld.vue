<script setup>
import store from '@/stores';
import { ref, computed } from 'vue';

defineProps({
  msg: {
    type: String,
    required: true
  }
})

const test = computed(()=>store.state.test)
</script>

<template>
  <div >
 
    <h1 className="text-3xl font-bold underline italic bg-green-400">
      Hello world! {{ test }}
    </h1>

  </div>
</template>

<style scoped>


@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>
