<script setup>
import axios from 'axios';
import { ref, onMounted } from "vue";

const user = ref([]);
const decks = ref([]);
const cards = ref([]);
const currentDeck = ref(null);
const isLoading = ref(true);

const getAuth = () => {
    axios.get('/api/getAuth')
    .then((response) => {
        user.value = response.data;
        getDecks(user.value.id);
    }) 
}

const findDeckWithCards = async () => {
    if (decks.value.length === 0) return null;
    
    for (let i = 0; i < decks.value.length; i++) {
        try {
            const response = await axios.get('/api/cards', { params: { id: decks.value[i].id } });
            if (response.data.length > 0) {
                currentDeck.value = decks.value[i];
                cards.value = response.data;
                return decks.value[i];
            }
        } catch (error) {
            console.error('Error checking deck cards:', error);
        }
    }
    return null;
};

const getDecks = (userId) => {
    axios.get('/api/decks', { params: { id: userId } })
    .then((response) => {
        decks.value = response.data;
        if (decks.value.length > 0) {
            findDeckWithCards().finally(() => {
                isLoading.value = false;
            });
        } else {
            isLoading.value = false;
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
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
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Study Again?</h5>
                <div v-if="isLoading" class="d-flex justify-content-center">
                  <p class="card-text">&nbsp;</p>

                          </div>
                          <p v-else class="card-text">
                            You've used the "{{currentDeck.title}}" deck recently, want to study again?
                          </p>
              
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Do you remember?</h5>

                          <div v-if="isLoading" class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                            </div>
                          </div>
                          <p v-else class="card-text">
                            {{currentDeck && cards.length > 0 ? `${cards[0].front}` : 'No cards available'}}
                          </p>
                          

                          
                        </div>
                      </div>

                    </div>
                    
                    <div class="col-lg-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title"></h5>

                          <div v-if="isLoading" class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                            </div>
                          </div>
                          <p v-else class="card-text blurred-content">
                            {{currentDeck && cards.length > 0 ? `${cards[0].back}` : 'No cards available'}}
                          </p>
                          

                          
                        </div>
                      </div>

                    </div>
                    <!-- /.col-md-6 -->
                  </div>
                  <!-- /.row -->
                </div><!-- /.container-fluid -->
                          

                
                <a :href="`/studySets/${currentDeck?.id}`" class="btn btn-primary" v-if="currentDeck">Study "{{currentDeck.title}}"</a>
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Another dashboard temp card</h5>

                <p class="card-text">
                  Temp text
                </p>
               
                    
                    
      
                
                <a :href="`/studySets`" class="btn btn-primary" v-if="currentDeck">Study</a>
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
</template>

<style scoped>
.blurred-content {
  filter: blur(5px);
  transition: filter 0.3s ease;
}

.blurred-content:hover {
  filter: blur(0);
}
</style>