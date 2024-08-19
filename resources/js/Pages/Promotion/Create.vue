<template>
    <div class="detail" style="margin-top: 100px;">
      <section class="content">
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
    
          </div>
          <div class="col-md-6">
        
            <div class="card card-primary">
            <div class="card-header" style="background: #2a2185;">
            <h3 class="card-title">Ajout d'une promotion</h3>
            </div>
              <form @submit.prevent="soumettre">
                <div class="card-body">
                <div class="form-group">
                <label for="exampleInputEmail1">Titre du promotion :</label>
                <input type="text" class="form-control" id="exampleInputEmail1" v-model="form.titre" :class="{'is-invalid': form.errors.titre}" required>
                <span v-if="form.errors.titre" class="invalid-feedback error">{{ form.errors.titre }}</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Ancien fonction :</label>
                  <input name="exampleInputPassword1" class="form-control" v-model="form.an_fonction_id" :class="{'is-invalid': form.errors.an_fonction_id}" required/>
                  <span v-if="form.errors.an_fonction_id" class="invalid-feedback error">{{ form.errors.an_fonction_id }}</span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nouveau fonction :</label>
                    <input name="exampleInputPassword1" class="form-control" v-model="form.nv_fonction_id" :class="{'is-invalid': form.errors.nv_fonction_id}" required/>
                    <span v-if="form.errors.nv_fonction_id" class="invalid-feedback error">{{ form.errors.nv_fonction_id }}</span>
                    </div>
                </div>
                
                <div class="card-footer">
                  <Link :href="route('promotion')" class="btn btn-danger mr-2">Retour</Link>
                <button type="submit" class="btn btn-success">Soumettre</button>
                </div>
                </form>
     
            </div>
          </div>
        <div class="col-md-4">
        
      </div>
    </div>
    </div>
    </section>
    </div>
    
    </template>
    
    <script setup>
       import { useForm } from '@inertiajs/inertia-vue3';
       import { useSwalSuccess, useSwalError } from '../../Composables/alert';
       import { ref } from 'vue';
    
       const props = defineProps({
        Fonctions: Array
       })
       const form = useForm({
        titre: "",
        nv_fonction_id: "",
        an_fonction_id: "",
        
       })
       const soumettre = ()=>{
        form.post(route("promotion.store"), {
            onSuccess: (page)=>{
                useSwalSuccess("Promotion ajouté avec success !")
                form.reset()
    
            },
            onError: (errors)=>{
                useSwalError("Une erreur a été produite :(")
    
            }
        })
      }
    </script>
    