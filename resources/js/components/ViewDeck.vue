<script>
export default {
  props: ['id'],
  data() {
    return {
      deck: [],
      deckId: null, 
    };
  },
  mounted() {
    this.deckId = this.id;
    this.getDeck(this.deckId);
  },
  methods: {
    getDeck(deckId) {
      axios.get('/api/getDeck', { params: { id: deckId } })
        .then((response) => {
          this.deck = response.data;
        })
        .catch((error) => {
          console.error('Error fetching deck:', error);
        });
    },
  },
};
</script>

<template>
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
</template>
  