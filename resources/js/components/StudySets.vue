<script setup>
import axios from 'axios';
import { ref, onMounted } from "vue";

const users = ref([]);
const user = ref([]);
const decks = ref([]);


const getAuth = () => {
    axios.get('/api/getAuth')
    .then((response) => {
        user.value = response.data;
        getDecks(user.value.id);
    }) 
}

const getDecks = (userId) => {
    axios.get('/api/decks', { params: { id: userId } })
    .then((response) => {
        decks.value = response.data;
    }) 
}


const addNewDeck = () => {
    
}

const deleteDeck = (deckId) => {
    axios.post('/api/deleteDeck', { params: { id: deckId } })
    .then((response) => {
     
    }) 
}

onMounted(() => {
    getAuth();
});
</script>

<template>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <div class="row mb-2">
                <h1 class="m-0" style="padding-left: 10px;">Study Sets</h1>
                <!-- <button @click="getUsers" class="btn btn-primary" style="margin-left: 20px;">Refresh Decks</button>  -->
                <button @click="addNewDeck" class="btn btn-primary" style="margin-left: 10px;">New Deck</button>
              </div>
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
              <li class="breadcrumb-item active">Study Sets</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
    <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        
        <!-- Loop through decks -->
        <div class="col-lg-4" v-for="deck in decks" :key="deck.id">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="m-0">{{ deck.title }}</h5>
              <button
                class="btn btn-outline-danger btn-sm"
                style=""
                @click="deleteDeck(deck.id)"
              >
                <i :class="'fas fa-trash-alt'"></i>
              </button>
            </div>
            <div class="card-body">
              <p class="card-text">{{ deck.description }}</p>
              <a href="#" class="btn btn-primary">View Deck</a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
      
      
    

</template>