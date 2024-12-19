<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';

const props = defineProps(['id']);

// State
const deck = ref(null);
const cards = ref([]);
const deckId = ref(null);
const currentCardIndex = ref(0);
const isFlipped = ref(false);

// Methods
const getDeck = (id) => {
  axios.get('/api/getDeck', { params: { id } })
    .then((response) => {
      deck.value = response.data;
      getCards(id);
    })
    .catch((error) => {
      console.error('Error fetching deck:', error);
    });
};

const getCards = (id) => {
  axios.get('/api/cards', { params: { id } })
    .then((response) => {
      cards.value = response.data;
    })
    .catch((error) => {
      console.error('Error fetching cards:', error);
    });
};

// Computed properties
const currentCard = computed(() => cards.value[currentCardIndex.value] || null);
const totalCards = computed(() => cards.value.length);

// Card functions
const flipCard = () => {
  isFlipped.value = !isFlipped.value;
};

const nextCard = () => {
  if (currentCardIndex.value < totalCards.value - 1) {
    currentCardIndex.value++;
    isFlipped.value = false;
  }
};

const previousCard = () => {
  if (currentCardIndex.value > 0) {
    currentCardIndex.value--;
    isFlipped.value = false;
  }
};

// Initialize
deckId.value = props.id;
getDeck(deckId.value);
</script>

<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" v-if="deck">Viewing Deck: {{ deck.title }}</h1>
            <p v-else>Loading deck details...</p>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
              <li class="breadcrumb-item"><router-link to="/studysets">Study Sets</router-link></li>
              <li class="breadcrumb-item active" v-if="deck">{{ deck.title }}</li>
              <li class="breadcrumb-item" v-else>Loading...</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card-container" v-if="currentCard">
              <button 
                class="nav-button prev" 
                @click="previousCard"
                :disabled="currentCardIndex === 0"
              >
                <i class="fas fa-chevron-left"></i>
              </button>

              <div 
                class="flashcard" 
                :class="{ 'is-flipped': isFlipped }"
                @click="flipCard"
              >
                <div class="flashcard-inner">
                  <div class="flashcard-front">
                    <div class="card-content">{{ currentCard.front }}</div>
                  </div>
                  <div class="flashcard-back">
                    <div class="card-content">{{ currentCard.back }}</div>
                  </div>
                </div>
              </div>

              <button 
                class="nav-button next" 
                @click="nextCard"
                :disabled="currentCardIndex === totalCards - 1"
              >
                <i class="fas fa-chevron-right"></i>
              </button>
            </div>

            <div class="text-center mt-4" v-if="totalCards > 0">
              Card {{ currentCardIndex + 1 }} of {{ totalCards }}
            </div>

            <div v-else class="text-center">
              <p>No cards found in this deck.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 2rem;
  padding: 2rem;
}

.flashcard {
  width: 500px;
  height: 300px;
  perspective: 1000px;
  cursor: pointer;
}

.flashcard-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.flashcard.is-flipped .flashcard-inner {
  transform: rotateY(180deg);
}

.flashcard-front, .flashcard-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  border-radius: 10px;
  padding: 20px;
}

.flashcard-back {
  transform: rotateY(180deg);
  background-color: #f8f9fa;
}

.card-content {
  font-size: 1.5rem;
  padding: 20px;
  word-wrap: break-word;
}

.nav-button {
  background: none;
  border: none;
  font-size: 2rem;
  color: #6c757d;
  cursor: pointer;
  padding: 10px;
  transition: color 0.3s ease;
}

.nav-button:hover:not(:disabled) {
  color: #007bff;
}

.nav-button:disabled {
  color: #dee2e6;
  cursor: not-allowed;
}

.flashcard:hover .flashcard-inner {
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}
</style>
  