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

const newDeckTitle = ref("");
const newDeckDescription = ref("");

const addNewDeck = () => {


    axios.post('/api/addDeck', {
        title: newDeckTitle.value,
        description: newDeckDescription.value,
        userId: user.value.id,
    })
    .then((response) => {
        decks.value.push(response.data);
        newDeckTitle.value = "";
        newDeckDescription.value = "";
    })
    
}

const deleteDeck = (deckId) => {
    axios.post('/api/deleteDeck', {
        id: deckId,
        userId: user.value.id,
    })
    .then((response) => {
      if (response.data == true) {
          decks.value = decks.value.filter(item => item.id !== deckId);
      } else {
        
      }
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
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDeckModal" style="margin-left: 20px;">
                    <i :class="'fas fa-folder-plus'"></i>
                    &nbsp;Create New Deck
                  </button>
              </div>
              
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
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
                style="margin-left: 60%"
                @click="deleteDeck(deck.id)"
              >
                <i :class="'fas fa-trash-alt'"></i>
              </button>
            </div>
            <div class="card-body">
              <p class="card-text">{{ deck.description }}</p>
              <router-link 
                :to="{ name: 'viewDeck', params: { id: deck.id } }" 
                class="btn btn-primary">
                View Deck
              </router-link>            
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="addDeckModal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create New Deck</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control " id="title"
                                aria-describedby="nameHelp" placeholder="Untitiled" v-model="newDeckTitle">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" v-model="newDeckDescription" id="description" name="description" placeholder="Enter text..."></textarea><br>

                        </div>
                    </form>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                    <button @click="addNewDeck()" type="button" class="btn btn-primary" data-dismiss="modal">Create</button>
                    
                </div>
            </div>
        </div>
    </div>
      
      
    

</template>