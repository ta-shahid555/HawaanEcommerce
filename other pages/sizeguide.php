<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php'); ?>


  <!--
    - MAIN
  -->

<main>
     <style>
    .size-guide-container {
      padding: 60px 0;
      background: #f8f9fa;
      min-height: 80vh;
    }

    .size-guide-header {
      text-align: center;
      margin-bottom: 60px;
    }

    .size-guide-title {
      font-size: 3rem;
      color: #333;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .size-guide-subtitle {
      color: #666;
      font-size: 1.2rem;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .size-sections {
      display: grid;
      gap: 40px;
      margin-bottom: 60px;
    }

    .size-section {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .size-section:hover {
      transform: translateY(-5px);
    }

    .section-title {
      font-size: 2rem;
      color: #333;
      margin-bottom: 30px;
      font-weight: 600;
      text-align: center;
      position: relative;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: var(--salmon-pink);
      border-radius: 2px;
    }

    .size-table {
      width: 100%;
      border-collapse: collapse;
      margin: 30px 0;
      font-size: 1rem;
    }

    .size-table th {
      background: var(--salmon-pink);
      color: white;
      padding: 15px;
      text-align: center;
      font-weight: 600;
      border: none;
    }

    .size-table td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #eee;
      color: #555;
    }

    .size-table tbody tr:nth-child(even) {
      background: #f8f9fa;
    }

    .size-table tbody tr:hover {
      background: #e3f2fd;
    }

    .measurement-info {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 25px;
      border-radius: 10px;
      margin-top: 30px;
    }

    .measurement-title {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .measurement-list {
      list-style: none;
      padding: 0;
    }

    .measurement-list li {
      margin-bottom: 10px;
      padding-left: 20px;
      position: relative;
      line-height: 1.5;
    }

    .measurement-list li::before {
      content: "✓";
      position: absolute;
      left: 0;
      color: #4caf50;
      font-weight: bold;
      font-size: 1.1rem;
    }

    .size-converter {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      text-align: center;
    }

    .converter-title {
      font-size: 2rem;
      color: #333;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .converter-subtitle {
      color: #666;
      margin-bottom: 30px;
      font-size: 1.1rem;
    }

    .converter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .converter-card {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      border: 2px solid transparent;
      transition: all 0.3s ease;
    }

    .converter-card:hover {
      border-color: var(--salmon-pink);
      background: white;
      transform: translateY(-3px);
    }

    .converter-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
      font-size: 1.1rem;
    }

    .converter-value {
      color: var(--salmon-pink);
      font-size: 1rem;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .size-guide-title {
        font-size: 2.2rem;
      }
      
      .size-section {
        padding: 25px;
      }
      
      .size-table {
        font-size: 0.9rem;
      }
      
      .size-table th,
      .size-table td {
        padding: 10px 8px;
      }
    }
  </style>
    <div class="size-guide-container">
      <div class="container">
        
        <div class="size-guide-header">
          <h1 class="size-guide-title">Size Guide</h1>
          <p class="size-guide-subtitle">
            Find your perfect fit with our comprehensive size guide. Use these measurements to ensure the best shopping experience and avoid returns.
          </p>
        </div>

        <div class="size-sections">
          
          <!-- Men's Clothing -->
          <div class="size-section">
            <h2 class="section-title">Men's Clothing</h2>
            
            <table class="size-table">
              <thead>
                <tr>
                  <th>Size</th>
                  <th>Chest (inches)</th>
                  <th>Waist (inches)</th>
                  <th>Hip (inches)</th>
                  <th>Shoulder (inches)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>XS</td>
                  <td>32-34</td>
                  <td>26-28</td>
                  <td>32-34</td>
                  <td>16-17</td>
                </tr>
                <tr>
                  <td>S</td>
                  <td>34-36</td>
                  <td>28-30</td>
                  <td>34-36</td>
                  <td>17-18</td>
                </tr>
                <tr>
                  <td>M</td>
                  <td>36-38</td>
                  <td>30-32</td>
                  <td>36-38</td>
                  <td>18-19</td>
                </tr>
                <tr>
                  <td>L</td>
                  <td>38-40</td>
                  <td>32-34</td>
                  <td>38-40</td>
                  <td>19-20</td>
                </tr>
                <tr>
                  <td>XL</td>
                  <td>40-42</td>
                  <td>34-36</td>
                  <td>40-42</td>
                  <td>20-21</td>
                </tr>
                <tr>
                  <td>XXL</td>
                  <td>42-44</td>
                  <td>36-38</td>
                  <td>42-44</td>
                  <td>21-22</td>
                </tr>
              </tbody>
            </table>

            <div class="measurement-info">
              <h4 class="measurement-title">How to Measure (Men's)</h4>
              <ul class="measurement-list">
                <li>Chest: Measure around the fullest part of your chest, keeping the tape horizontal</li>
                <li>Waist: Measure around your natural waistline, above your hip bones</li>
                <li>Hip: Measure around the fullest part of your hips</li>
                <li>Shoulder: Measure from shoulder point to shoulder point across your back</li>
              </ul>
            </div>
          </div>

          <!-- Women's Clothing -->
          <div class="size-section">
            <h2 class="section-title">Women's Clothing</h2>
            
            <table class="size-table">
              <thead>
                <tr>
                  <th>Size</th>
                  <th>Bust (inches)</th>
                  <th>Waist (inches)</th>
                  <th>Hip (inches)</th>
                  <th>Length (inches)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>XS</td>
                  <td>30-32</td>
                  <td>24-26</td>
                  <td>32-34</td>
                  <td>58-60</td>
                </tr>
                <tr>
                  <td>S</td>
                  <td>32-34</td>
                  <td>26-28</td>
                  <td>34-36</td>
                  <td>60-62</td>
                </tr>
                <tr>
                  <td>M</td>
                  <td>34-36</td>
                  <td>28-30</td>
                  <td>36-38</td>
                  <td>62-64</td>
                </tr>
                <tr>
                  <td>L</td>
                  <td>36-38</td>
                  <td>30-32</td>
                  <td>38-40</td>
                  <td>64-66</td>
                </tr>
                <tr>
                  <td>XL</td>
                  <td>38-40</td>
                  <td>32-34</td>
                  <td>40-42</td>
                  <td>66-68</td>
                </tr>
                <tr>
                  <td>XXL</td>
                  <td>40-42</td>
                  <td>34-36</td>
                  <td>42-44</td>
                  <td>68-70</td>
                </tr>
              </tbody>
            </table>

            <div class="measurement-info">
              <h4 class="measurement-title">How to Measure (Women's)</h4>
              <ul class="measurement-list">
                <li>Bust: Measure around the fullest part of your bust with arms relaxed</li>
                <li>Waist: Measure around the narrowest part of your waist</li>
                <li>Hip: Measure around the fullest part of your hips and buttocks</li>
                <li>Length: Measure from shoulder to desired hemline length</li>
              </ul>
            </div>
          </div>

          <!-- Kids Clothing -->
          <div class="size-section">
            <h2 class="section-title">Kids Clothing</h2>
            
            <table class="size-table">
              <thead>
                <tr>
                  <th>Age</th>
                  <th>Size</th>
                  <th>Height (inches)</th>
                  <th>Chest (inches)</th>
                  <th>Waist (inches)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>2-3 Years</td>
                  <td>2T</td>
                  <td>32-35</td>
                  <td>20-21</td>
                  <td>19-20</td>
                </tr>
                <tr>
                  <td>3-4 Years</td>
                  <td>3T</td>
                  <td>35-38</td>
                  <td>21-22</td>
                  <td>20-21</td>
                </tr>
                <tr>
                  <td>4-5 Years</td>
                  <td>4T</td>
                  <td>38-41</td>
                  <td>22-23</td>
                  <td>21-22</td>
                </tr>
                <tr>
                  <td>5-6 Years</td>
                  <td>5T</td>
                  <td>41-44</td>
                  <td>23-24</td>
                  <td>22-23</td>
                </tr>
                <tr>
                  <td>6-7 Years</td>
                  <td>6T</td>
                  <td>44-47</td>
                  <td>24-25</td>
                  <td>23-24</td>
                </tr>
              </tbody>
            </table>

            <div class="measurement-info">
              <h4 class="measurement-title">Kids Measurement Tips</h4>
              <ul class="measurement-list">
                <li>Height: Measure from head to toe without shoes, standing straight</li>
                <li>Chest: Measure around the fullest part of the chest</li>
                <li>Waist: Measure around the natural waistline</li>
                <li>Consider adding room for growth and comfort</li>
              </ul>
            </div>
          </div>

          <!-- Footwear -->
          <div class="size-section">
            <h2 class="section-title">Footwear Size Chart</h2>
            
            <table class="size-table">
              <thead>
                <tr>
                  <th>US Men</th>
                  <th>US Women</th>
                  <th>UK</th>
                  <th>EU</th>
                  <th>Length (cm)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>6</td>
                  <td>7.5</td>
                  <td>5.5</td>
                  <td>39</td>
                  <td>24.5</td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>8.5</td>
                  <td>6.5</td>
                  <td>40</td>
                  <td>25.0</td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>9.5</td>
                  <td>7.5</td>
                  <td>41</td>
                  <td>25.5</td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>10.5</td>
                  <td>8.5</td>
                  <td>42</td>
                  <td>26.0</td>
                </tr>
                <tr>
                  <td>10</td>
                  <td>11.5</td>
                  <td>9.5</td>
                  <td>43</td>
                  <td>26.5</td>
                </tr>
                <tr>
                  <td>11</td>
                  <td>12.5</td>
                  <td>10.5</td>
                  <td>44</td>
                  <td>27.0</td>
                </tr>
              </tbody>
            </table>

            <div class="measurement-info">
              <h4 class="measurement-title">Shoe Fitting Tips</h4>
              <ul class="measurement-list">
                <li>Measure feet in the evening when they are at their largest</li>
                <li>Measure both feet and use the larger measurement</li>
                <li>Leave about 1/2 inch space between your longest toe and shoe end</li>
                <li>Consider the width of your foot as well as the length</li>
              </ul>
            </div>
          </div>

        </div>

        <!-- Size Converter -->
        <div class="size-converter">
          <h2 class="converter-title">International Size Converter</h2>
          <p class="converter-subtitle">Quick reference for international sizing conversions</p>
          
          <div class="converter-grid">
            <div class="converter-card">
              <div class="converter-label">US Small</div>
              <div class="converter-value">UK 8 | EU 36</div>
            </div>
            <div class="converter-card">
              <div class="converter-label">US Medium</div>
              <div class="converter-value">UK 10 | EU 38</div>
            </div>
            <div class="converter-card">
              <div class="converter-label">US Large</div>
              <div class="converter-value">UK 12 | EU 40</div>
            </div>
            <div class="converter-card">
              <div class="converter-label">US X-Large</div>
              <div class="converter-value">UK 14 | EU 42</div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </main>

  <!--
    - FOOTER
  -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php'); ?>



  <!--
    - custom js link
  -->
  <script src="assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>