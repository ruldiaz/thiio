<template>
  <div>
    <h1>Welcome to the Dashboard!</h1>
    <p>This is where you can create, edit or delete users.</p>
    <v-btn color="primary" @click="logout">Logout</v-btn>

    <!-- Show Users -->
    <v-card v-for="user in users" :key="user.id" class="mb-3">
      <v-card-text>
        <p><strong>Name:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
        <p><strong>Password:</strong> {{ user.password }}</p>
        <p><strong>Phone:</strong> {{ user.phone }}</p>
        <p><strong>Language:</strong> {{ user.language }}</p>
        <v-btn color="primary" @click="editUser(user)">Edit</v-btn>
        <v-btn color="error" @click="deleteUser(user.id)">Delete</v-btn>
      </v-card-text>
    </v-card>

    <!-- Create User Button -->
    <v-btn color="success" @click="creatingUser = true">Create User</v-btn>

    <!-- Create User Dialog -->
    <v-dialog v-model="creatingUser" max-width="500">
      <v-card>
        <v-card-title>Create New User</v-card-title>
        <v-card-text>
          <v-text-field v-model="newUser.name" label="Name"></v-text-field>
          <v-text-field v-model="newUser.email" label="Email"></v-text-field>
          <v-text-field v-model="newUser.password" label="Password"></v-text-field>
          <v-text-field v-model="newUser.phone" label="Phone"></v-text-field>
          <v-text-field v-model="newUser.language" label="Language"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" @click="createUser">Create User</v-btn>
          <v-btn @click="creatingUser = false">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Edit User Dialog -->
    <v-dialog v-model="editingUserDialog" max-width="500">
      <v-card>
        <v-card-title>Edit User</v-card-title>
        <v-card-text>
          <v-text-field v-model="editedUser.name" label="Name"></v-text-field>
          <v-text-field v-model="editedUser.email" label="Email"></v-text-field>
          <v-text-field v-model="editedUser.phone" label="Phone"></v-text-field>
          <v-text-field v-model="editedUser.language" label="Language"></v-text-field>
          <div class="center-checkbox">
            <v-checkbox class="styled-checkbox" v-model="changePassword" color="primary">.....Change .........Password</v-checkbox>
          </div>
          <v-text-field v-if="changePassword" v-model="editedUser.password" label="New Password" type="password"></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" @click="saveEditedUser">Save</v-btn>
          <v-btn @click="cancelEditUser">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    
    
    
    
    
    
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      editingUser: null,
      creatingUser: false,
      newUser: { name: '', email: '', password: '', phone: '', language: '' },
      editedUser: { name: '', email: '', password: '', phone: '', language: '' },
      editingUserDialog: false,
      changePassword: false,
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/users');
        this.users = response.data.users;
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
    editUser(user) {
      this.editedUser = { ...user };
      this.editingUserDialog = true;
      this.changePassword = false; // Reset to false when opening the dialog
    },
    async saveUser() {
      try {
        await axios.put(`http://127.0.0.1:8000/api/users/${this.editingUser.id}`, this.editingUser);
        this.editingUser = null;
        this.fetchUsers();
      } catch (error) {
        console.error('Error saving user:', error);
      }
    },
    async deleteUser(userId) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/users/${userId}`);
        this.fetchUsers();
      } catch (error) {
        console.error('Error deleting user:', error);
      }
    },
    async createUser() {
      try {
        await axios.post('http://127.0.0.1:8000/api/users', this.newUser);
        this.newUser = { name: '', email: '', password: '', phone: '', language: '' };
        this.fetchUsers();
        this.creatingUser = false;
      } catch (error) {
        console.error('Error creating user:', error);
      }
    },
    logout() {
      this.$router.push('/');
    },
    saveEditedUser() {
      if (!this.changePassword) {
        delete this.editedUser.password; // Remove password from edited user if not changing it
      }
      
      axios.put(`http://127.0.0.1:8000/api/users/${this.editedUser.id}`, this.editedUser)
        .then(() => {
          this.editingUserDialog = false;
          this.fetchUsers();
      })
        .catch(error => {
          console.error('Error saving edited user:', error);
      });
  }
  }
};
</script>

<style scoped>
/* Add scoped styles if needed */
/* Center the text within the checkbox */
.center-checkbox {
  text-align: center;
}

.styled-checkbox .v-label {
  color: rgba(0, 0, 0, 0.87);
}

.styled-checkbox .v-input--selection-controls__input {
  border-color: rgba(0, 0, 0, 0.87);
}


</style>
