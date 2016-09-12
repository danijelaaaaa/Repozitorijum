package rs.reviewer;

import android.test.ActivityInstrumentationTestCase2;
import android.test.suitebuilder.annotation.SmallTest;
import android.widget.TextView;

/**
 * Created by milossimic on 3/10/16.
 */
public class MainActivityTest extends ActivityInstrumentationTestCase2<MainActivity> {

    MainActivity activity;

    public MainActivityTest(){
        super(MainActivity.class);
    }

    @Override
    protected void setUp() throws Exception {
        super.setUp();
        activity = getActivity();
    }

    @SmallTest
    public void testMainActivityView(){
        TextView  view = (TextView) activity.findViewById(R.id.textView2);

        assertNotNull("Testiranje da li je kreiran TextView object", view);
    }

    @SmallTest
    public void testViewName(){
        TextView  view = (TextView) activity.findViewById(R.id.textView2);

        assertEquals("Testiranje da li je sadrzaj polja onaj koji je zadat", "LinearLayoutFragment", view.getText().toString());
    }

    @SmallTest
    public void testIsNameEmpty(){
        TextView  view = (TextView) activity.findViewById(R.id.textView2);

        assertNotSame("Testiranje da li je polje prazno","", view.getText().toString());
    }
}
